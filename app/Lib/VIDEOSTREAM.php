<?php

namespace App\Lib;
use Exception;
class VIDEOSTREAM {

    private $file = '';
    public $ffmpeg_path = 'ffmpeg';
    private $output = '';
    protected static $REGEX_DURATION = '/Duration: ([0-9]{2}):([0-9]{2}):([0-9]{2})(\.([0-9]+))?/';
    protected static $REGEX_FRAME_RATE = '/([0-9\.]+\sfps,\s)?([0-9\.]+)\stbr/';
    protected static $REGEX_COMMENT = '/comment\s*(:|=)\s*(.+)/i';
    protected static $REGEX_TITLE = '/title\s*(:|=)\s*(.+)/i';
    protected static $REGEX_ARTIST = '/(artist|author)\s*(:|=)\s*(.+)/i';
    protected static $REGEX_COPYRIGHT = '/copyright\s*(:|=)\s*(.+)/i';
    protected static $REGEX_GENRE = '/genre\s*(:|=)\s*(.+)/i';
    protected static $REGEX_TRACK_NUMBER = '/track\s*(:|=)\s*(.+)/i';
    protected static $REGEX_YEAR = '/year\s*(:|=)\s*(.+)/i';
    protected static $REGEX_FRAME_WH = '/Video:.+?([1-9][0-9]*)x([1-9][0-9]*)/';
    protected static $REGEX_PIXEL_FORMAT = '/Video: [^,]+, ([^,]+)/';
    protected static $REGEX_BITRATE = '/bitrate: ([0-9]+) kb\/s/';
    protected static $REGEX_VIDEO_BITRATE = '/Video:.+?([0-9]+) kb\/s/';
    protected static $REGEX_AUDIO_BITRATE = '/Audio:.+?([0-9]+) kb\/s/';
    protected static $REGEX_AUDIO_SAMPLE_RATE = '/Audio:.+?([0-9]+) Hz/';
    protected static $REGEX_VIDEO_CODEC = '/Video:\s([^,]+),/';
    protected static $REGEX_AUDIO_CODEC = '/Audio:\s([^,]+),/';
    protected static $REGEX_AUDIO_CHANNELS = '/Audio:\s[^,]+,[^,]+,([^,]+)/';
    protected static $REGEX_HAS_AUDIO = '/Stream.+Audio/';
    protected static $REGEX_HAS_VIDEO = '/Stream.+Video/';
    protected static $REGEX_ERRORS = '/.*(Error|Permission denied|could not seek to position|Invalid pixel format|Unknown encoder|could not find codec|does not contain any stream).*/i';

    function isFFMPEG() {
        $ffmpeg_cmd = "ffmpeg";
        @exec($ffmpeg_cmd, $ffmpeg_output, $retval);
        if ($retval == 127)
            return false;
        else
            return true;
    }

    function load($video) {
//        echo $video;die;
        if (!file_exists($video))
            throw new Exception("Video not found ");

        $this->file = $video;
        $ffmpeg_output = array();

        $ffmpeg_cmd = $this->ffmpeg_path . " -i '" . $video . '\' 2>&1 | cat | egrep -e \'(Duration|Stream)\'';
        @exec($ffmpeg_cmd, $ffmpeg_output);
        $this->output = implode(PHP_EOL, $ffmpeg_output);
    }

    function getDetailInfo() {
        $options = ' -v quiet -print_format json -show_format -show_streams';
        $json = json_decode(shell_exec(sprintf('ffprobe %s %s', $options, escapeshellarg($this->file))));
        //$ffmpeg_cmd = 'ffprobe -v quiet -print_format json -show_format -show_streams '.$this->file;
        //@exec($ffmpeg_cmd, $output);
        return ($json);
    }

    public function getDuration() {
        $match = array();
        $duration = '';
        preg_match(self::$REGEX_DURATION, $this->output, $match);
        if (array_key_exists(1, $match) && array_key_exists(2, $match) && array_key_exists(3, $match)) {
            $hours = (int) $match[1];
            $minutes = (int) $match[2];
            $seconds = (int) $match[3];
            $fractions = (float) ((array_key_exists(5, $match)) ? "0.$match[5]" : 0.0);
            $duration = (($hours * (3600)) + ($minutes * 60) + $seconds + $fractions);
        } else {
            $duration = 0.0;
        }

        return $duration;
    }

    public function getFrameCount() {
        $frameCount = (int) ($this->getDuration() * $this->getFrameRate());
        return $frameCount;
    }

    public function getFrameRate() {
        $match = array();
        preg_match(self::$REGEX_FRAME_RATE, $this->output, $match);
        $frameRate = (float) ((array_key_exists(1, $match)) ? $match[1] : 0.0);


        return $frameRate;
    }

    public function getFrameHeight() {
        $match = array();
        preg_match(self::$REGEX_FRAME_WH, $this->output, $match);

        if (array_key_exists(1, $match) && array_key_exists(2, $match)) {
            $frame['width'] = (int) $match[1];
            $frame['height'] = (int) $match[2];
        } else {
            $frame['width'] = 0;
            $frame['height'] = 0;
        }

        return $frame;
    }

    /**
     * Return the width of the movie in pixels.
     *
     * @return int 
     */
    public function getFrameWidth() {
        $arr = $this->getFrameHeight();


        return $arr;
    }

    /**
     * Return the pixel format of the movie.
     *
     * @return string 
     */
    public function getPixelFormat() {
        $match = array();
        preg_match(self::$REGEX_PIXEL_FORMAT, $this->output, $match);
        $pixelFormat = (array_key_exists(1, $match)) ? trim($match[1]) : '';
        return $pixelFormat;
    }

    public function getBitRate() {
        $match = array();
        preg_match(self::$REGEX_BITRATE, $this->output, $match);
        $bitRate = (int) ((array_key_exists(1, $match)) ? ($match[1] * 1000) : 0);
        return $bitRate;
    }

    /**
     * Return the bit rate of the video in bits per second.
     *  
     * NOTE: This only works for files with constant bit rate.
     *
     * @return int 
     */
    public function getVideoBitRate() {
        $match = array();
        preg_match(self::$REGEX_VIDEO_BITRATE, $this->output, $match);
        $videoBitRate = (int) ((array_key_exists(1, $match)) ? ($match[1] * 1000) : 0);

        return $videoBitRate;
    }

    /**
     * Return the audio bit rate of the media file in bits per second.
     *
     * @return int 
     */
    public function getAudioBitRate() {
        $match = array();
        preg_match(self::$REGEX_AUDIO_BITRATE, $this->output, $match);
        $audioBitRate = (int) ((array_key_exists(1, $match)) ? ($match[1] * 1000) : 0);

        return $audioBitRate;
    }

    /**
     * Return the audio sample rate of the media file in bits per second.
     *
     * @return int 
     */
    public function getAudioSampleRate() {
        $match = array();
        preg_match(self::$REGEX_AUDIO_SAMPLE_RATE, $this->output, $match);
        $audioSampleRate = (int) ((array_key_exists(1, $match)) ? $match[1] : 0);

        return $audioSampleRate;
    }

    /**
     * Return the name of the video codec used to encode this movie as a string.
     * 
     * @return string 
     */
    public function getVideoCodec() {
        $match = array();
        preg_match(self::$REGEX_VIDEO_CODEC, $this->output, $match);
        $videoCodec = (array_key_exists(1, $match)) ? trim($match[1]) : '';

        return $videoCodec;
    }

    /**
     * Return the name of the audio codec used to encode this movie as a string.
     *
     * @return string 
     */
    public function getAudioCodec() {
        $match = array();
        preg_match(self::$REGEX_AUDIO_CODEC, $this->output, $match);
        $audioCodec = (array_key_exists(1, $match)) ? trim($match[1]) : '';

        return $audioCodec;
    }

    /**
     * Return the number of audio channels in this movie as an integer.
     * 
     * @return int
     */
    public function getAudioChannels() {
        $match = array();
        preg_match(self::$REGEX_AUDIO_CHANNELS, $this->output, $match);

        if (array_key_exists(1, $match)) {

            switch (trim($match[1])) {
                case 'mono':
                    $audioChannels = 1;
                    break;
                case 'stereo':
                    $audioChannels = 2;
                    break;
                case '5.1':
                    $audioChannels = 6;
                    break;
                case '5:1':
                    $audioChannels = 6;
                    break;
                default:
                    $audioChannels = (int) $match[1];
            }
        } else {
            $audioChannels = 0;
        }


        return $audioChannels;
    }

    /**
     * Return boolean value indicating whether the movie has an audio stream.
     *
     * @return boolean 
     */
    public function hasAudio() {
        return (boolean) preg_match(self::$REGEX_HAS_AUDIO, $this->output);
    }

    /**
     * Return boolean value indicating whether the movie has a video stream.
     *
     * @return boolean 
     */
    public function hasVideo() {
        return (boolean) preg_match(self::$REGEX_HAS_VIDEO, $this->output);
    }

    function video_info() {
        $info = array();
        $info['duration'] = $this->getDuration();
        $info['frameCount'] = $this->getFrameCount();
        $info['frameRate'] = $this->getFrameRate();
        $info['size'] = $this->getFrameWidth();
        $info['bitRate'] = $this->getBitRate();
        $info['videoBitRate'] = $this->getVideoBitRate();
        $info['audioBitRate'] = $this->getAudioBitRate();
        $info['audioSampleBitRate'] = $this->getAudioSampleRate();
        $info['videoCodec'] = $this->getVideoCodec();
        $info['audioCodec'] = $this->getAudioCodec();
        $info['audioChannel'] = $this->getAudioChannels();
        $info['hasAudio'] = $this->hasAudio();
        $info['hasVideo'] = $this->hasVideo();


        return $info;
    }

    function covert3GPtoMP4($targetPath) {
        $command = $this->ffmpeg_path . ' -i ' . $this->file . '';
        $cmd = $command . ' -strict -2 ' . $targetPath;
        @exec($cmd, $ffmpeg_output, $retval);
        if ($retval == 0)
            return true;
    }

    function convertMOVtoMP4($targetPath) {
        $command = $this->ffmpeg_path . ' -i ' . $this->file . ' -vcodec copy -acodec copy ';
        $cmd = $command . ' ' . $targetPath;

        @exec($cmd, $ffmpeg_output, $retval);
        if ($retval == 0)
            return true;
    }

    public function convertVideo($targetPath, $transpose = 0, $compression = 100, $fastest = 1) {
        $size = '';
        $s = $this->getDetailInfo();
        $ratio = ($s->streams[0]->display_aspect_ratio);
        $fastCmd = '';
        $isCrop = true;
//$crop='';
        //ffmpeg -i /var/www/html/cheftalk-app/_tmp_/6621468393810.m4v -vf "scale=640:ih*640/iw, crop=640:640" -c:v libx264 -crf 25 -c:a copy /var/www/html/cheftalk-app/_tmp_/30.mp4
        if ($isCrop) {
            $sz = $this->getFrameWidth();
            if ($sz['width'] > 640 or $sz['height'] > 640)
                $crop = ' -s 640x480 -b:v 512k -vcodec mpeg1video -acodec copy ';
            else
                $crop = ' -crf 25 -c:a copy';
        }

        if ($fastest)
            $fastCmd = " -preset medium -movflags +faststart ";

        $command = $this->ffmpeg_path . ' -i ' . $this->file . $crop . ' -c:v libx264 ' . $fastCmd;

        if ((int) $compression < 100) {
            $compression = 100 - $compression;
            $size = $this->getFrameWidth();
            $oWidth = $size['width'];
            $oHeight = $size['height'];
            $width = ceil($oWidth - (($oWidth * (int) $compression) / 100));
            $height = ceil($oHeight - (($oHeight * (int) $compression) / 100));
            $size = " -s {$width}x{$height}";
        }
        if ($transpose > 0)
            $rotate = ' -vf transpose=' . $transpose . " "; //.' -aspect '.$ratio;
        else
            $rotate = '';

        $cmd = $command . $size . $targetPath;
      
        //  $cmd = "ffmpeg -i /var/www/html/sow/storage/app/public/1543223360-2936.mp4  -vcodec libx264 -crf 20 /var/www/html/sow/storage/app/public/ouy.mp4";
        //$cmd = "ffmpeg -i /var/www/html/sow/storage/app/public/1543223360-2936.mp4 -s 640x480 -b:v 512k -vcodec mpeg1video -acodec copy /var/www/html/sow/storage/app/public/1543223360-2936.mp4";
        @exec($cmd, $ffmpeg_output, $retval);
        //echo $retval;
        if ($retval == 0) {
            unlink($this->file);
            return true;
        } else
            return false;
    }

    function fadeIn($srcFile, $frameRate) {
        $path = pathinfo($srcFile);

        $path = $path['dirname'];
        $targetFile = time() . "-fadein-logo.mp4";
        $cmd = $this->ffmpeg_path . " -i " . $srcFile . " -y -vf fade=in:0:" . ceil($frameRate) . " -strict -2 " . $path . "/" . $targetFile;

        @exec($cmd, $ffmpeg_output, $retval);
        if ($retval == 0) {
            unlink($srcFile);
            return $this->fadeOut($path . "/" . $targetFile, $frameRate);
            ;
        }
    }

    function fadeOut($srcFile, $frameRate) {
        $path = pathinfo($srcFile);

        $path = $path['dirname'];
        $targetFile = time() . "-final-logo.mp4";
        $stFrameRate = ($frameRate * 2);
        $cmd = $this->ffmpeg_path . " -i " . $srcFile . " -y -vf fade=out:" . ceil($stFrameRate) . ":" . ceil($frameRate) . " -strict -2 " . $path . "/" . $targetFile;

        @exec($cmd, $ffmpeg_output, $retval);
        if ($retval == 0) {
            unlink($srcFile);
            return $targetFile;
        }
    }

    private function getOptimalCrop($newWidth, $newHeight) {
        $imgWidth = 1920;
        $imgHeight = 1080;

        $heightRatio = $imgHeight / $newHeight;
        $widthRatio = $imgWidth / $newWidth;

        if ($heightRatio < $widthRatio) {
            $optimalRatio = $heightRatio;
        } else {
            $optimalRatio = $widthRatio;
        }

        $optimalHeight = $imgWidth / $optimalRatio;
        $optimalWidth = $imgWidth / $optimalRatio;


        $cropStartX = ( $optimalWidth / 2) - ( $newWidth / 2 );
        $cropStartY = ( $optimalHeight / 2) - ( $newHeight / 2 );

        return array('cropX' => $cropStartX, 'cropY' => $cropStartY);
    }

    function createVideoFromImage($imageFile, $sec = 5, $bitRate, $ar, $ab, $ac, $size = array("width" => 720, "height" => 480), $outPutFileName, $transpose = 0, $logo = false) {
        $logoVideo = "";
        $blank_sound = realpath("../includes/sounds/silence.mp3");
        //$empty	=	"ffmpeg -filter_complex aevalsrc=0 -c:a libfdk_aac -t ".$sec." ".$blank_sound;
        //@exec($empty, $ffmpeg_output,$retval);
        //exit;

        $a = " -i " . $blank_sound . " -ar " . $ar . " -ab " . $ab . " -ac " . $ac . " -c:a aac -strict experimental ";
        $command = $this->ffmpeg_path . ' -loop 1 -i ' . $imageFile . $a . ' -c:v libx264 -t ' . $sec . " -r " . $bitRate;


        if (is_array($size)) {
            $width = $size['width'];
            $height = $size['height'];
            $videoSize = " -s {$width}x{$height}";
        }
        /*
          if ($logo){
          $optionArray 	= 	$this->getOptimalCrop($width, $height);
          $cropStartX 	= 	$optionArray['cropX'];
          $cropStartY 	= 	$optionArray['cropY'];
          $crop			=	' crop='.$width.':'.$height.':'.$cropStartX.':'.$cropStartY.' ';
          }
         */


        if ($transpose > 0)
            $command .= ' -vf "transpose=' . $transpose . '"';



        $cmd = $command . $videoSize . " -pix_fmt yuv420p " . $outPutFileName;
        //echo $cmd."\n";


        @exec($cmd, $ffmpeg_output, $retval);

        if ($retval == 0) {
            if ($logo)
                $logoVideo = $this->fadeIn($outPutFileName, $bitRate);
            else
                $logoVideo = NULL;
            return $logoVideo;
        } else
            return $ffmpeg_output;
    }

    function mergeVideo($videoList, $targetPath, $transpose = 0) {
        $tsArray = array();
        if (!is_array($videoList))
            return false;


        $tmpPath = realPath("../videos") . "/_tmp_/";
        for ($i = 0; $i <= count($videoList) - 1; $i++) {
            $cmd = $this->ffmpeg_path . " -i " . $videoList[$i] . " -c copy -bsf:v h264_mp4toannexb -f mpegts -y " . $tmpPath . "input" . $i . ".ts";
            array_push($tsArray, $tmpPath . "input" . $i . ".ts");
            @exec($cmd, $ffmpeg_output, $retval);
        }
        $concat = implode('|', $tsArray);
        $concat = '"concat:' . $concat . '"';


        $cmd = $this->ffmpeg_path . " -i " . $concat . " -bsf:a aac_adtstoasc -c copy " . $targetPath;

        @exec($cmd, $ffmpeg_output, $retval);
        foreach ($tsArray as $ts) {
            unlink($ts);
        }

        foreach ($videoList as $vd) {
            unlink($tmpPath . "" . basename($vd));
        }


        if ($retval == 0)
            return true;
    }

    public function getFrameAtTime($seconds = null, $width = null, $height = null, $quality = null, $frameFilePath = null, $transpose = 0, &$output = null) {
        // Set frame position for frame extraction
        $frameTime = ($seconds === null) ? 0 : $seconds;
        if (is_null($frameFilePath) or $frameFilePath == '') {
            $ff_dest_file = realpath('../') . '/_tmp_/' . time() . ".jpg";
        } else {
            $ff_dest_file = $frameFilePath;
        }

        // time out of range
        if($this->getDuration()<$frameTime){
            $frameTime = 1;
        }
        if (!is_numeric($frameTime) || $frameTime < 0 || $frameTime > $this->getDuration()) {
            throw(new Exception('Frame time is not in range ' . $frameTime . '/' . $this->getDuration() . ' '));
        }

        if (is_numeric($height) && is_numeric($width)) {
            $image_size = ' -s ' . $width . 'x' . $height;
        } else {
            $image_size = '';
        }

        if (is_numeric($quality)) {
            $quality = ' -qscale ' . $quality;
        } else {
            $quality = '';
        }

        if ($frameTime > 30) {
            $seek1 = $frameTime - 30;
            $seek2 = 30;
        } else {
            $seek1 = 0;
            $seek2 = $frameTime;
        }

        if ($transpose > 0)
            $rotate = ' -vf transpose=' . $transpose; //.' -aspect '.$ratio;
        else
            $rotate = ' ';



        $cmd = $this->ffmpeg_path . " -i $this->file -an -ss $seek1 -r 1 -vframes 1 $rotate $image_size -y $ff_dest_file";
        @exec($cmd, $output, $retval);
        if ($retval == 0) {
            //	$this->downloadFile($ff_dest_file);
        }
    }

    private function downloadFile($filename) {
        header("Pragma: public"); // required
        header("Expires: 0");
        header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
        header("Cache-Control: private", false); // required for certain browsers 
        header("Content-Type: image/jpg");
        // change, added quotes to allow spaces in filenames,
        header("Content-Disposition: attachment; filename=\"" . basename($filename) . "\";");
        header("Content-Transfer-Encoding: binary");
        header("Content-Length: " . filesize($filename));
        ob_clean();
        flush();
        readfile($filename);
        exit();
    }

}

?>