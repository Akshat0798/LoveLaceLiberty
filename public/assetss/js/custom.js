$(document).ready(function() {
    $('.toggle-icon').click(function() {
        $('.sidebar').toggleClass('smSide');
    });
});
$(document).ready(function() {
    $('select.themeInput').each(function() {
        $(this).find('option').addClass('option-class'); // Add class to each option
        $(this).find('option:selected').css("background","red !important")
    });
});

// map js
$(document).ready(function() {
    let lastSelectedState = '';

    $('#map').usmap({
        click: function(event, data) {
            if (lastSelectedState) {
                $('#' + lastSelectedState).css('background-color', '');
            }
            if (data.name !== lastSelectedState) {
                lastSelectedState = data.name; 
                $('#selected-state > span').text(data.name).css({"font-weight": "bold", "color": "#FF6E6E"});
                $('#' + data.name).css('background-color', '#FF6E6E'); // Set to the same color as the text
            }
        }
    });
    $('#map').on('mouseleave', function() {
        if (lastSelectedState === '') {
            $('#selected-state > span').text('Select state to find out').css({"font-weight": "normal", "color": "#fff"});
        }
    });
});

// map js
$(document).ready(function() {
    $('#ElectionYear').focus(function() {
        $(this).attr('type', 'date');
    }).blur(function() {
        if (!$(this).val()) {
            $(this).attr('type', 'text');
        }
    });
});


$('.themeColor').on('change', function() {
  var file = this.files[0],
      filename = file.name,
      $label = $(this).next('.file'),
      $preview = $(this).closest('.wrap').find('.preview'), // Find the correct preview
      img = document.createElement("img"),
      reader = new FileReader();

  if (file) {
      img.file = file;
      img.classList.add("img-responsive");

      // Clear previous content in the preview
      $preview.empty();

      reader.onload = (function(aImg) {
          return function(e) {
              aImg.src = e.target.result;
              $preview.append(aImg); // Add the new image to the preview
          };
      })(img);

      reader.readAsDataURL(file);

      $label
          .attr('data-label', filename)
          .addClass('active');
  }
});





  window.onload = function() {
    setTimeout(function() {
        const messageElement = document.querySelector('.message');
        if (messageElement) {
            messageElement.classList.add('show');
        }
    }, 2000); // 2000 milliseconds = 2 seconds
};

// Close message when the close button is clicked
document.addEventListener('click', function(event) {
    if (event.target.classList.contains('closeMsg')) {
        const messageElement = event.target.closest('.message');
        if (messageElement) {
            messageElement.classList.remove('show');
        }
    }
});


window.addEventListener("DOMContentLoaded", () => {
    // update circle when range change
    const pie = document.querySelectorAll(".pie");
    const range = document.querySelector('[type="range"]');
  
    range.addEventListener("input", (e) => {
      pie.forEach((el, index) => {
        const options = {
          index: index + 1,
          percent: e.target.value
        };
        circle.animationTo(options);
      });
    });
  
    // start the animation when the element is in the page view
    const elements = [].slice.call(document.querySelectorAll(".pie"));
    const circle = new CircularProgressBar("pie");
  
    // circle.initial();
  
    if ("IntersectionObserver" in window) {
      const config = {
        root: null,
        rootMargin: "0px",
        threshold: 0.75
      };
  
      const ovserver = new IntersectionObserver((entries, observer) => {
        entries.map((entry) => {
          if (entry.isIntersecting && entry.intersectionRatio > 0.75) {
            circle.initial(entry.target);
            observer.unobserve(entry.target);
          }
        });
      }, config);
  
      elements.map((item) => {
        ovserver.observe(item);
      });
    } else {
      elements.map((element) => {
        circle.initial(element);
      });
    }
  
    setInterval(() => {
      const typeFont = [100, 200, 300, 400, 500, 600, 700];
      const colorHex = `#${Math.floor((Math.random() * 0xffffff) << 0).toString(
        16
      )}`;
      const options = {
        index: 17,
        percent: Math.floor(Math.random() * 100 + 1),
        colorSlice: colorHex,
        fontColor: colorHex,
        fontSize: `${Math.floor(Math.random() * (1.4 - 1 + 1) + 1)}rem`,
        fontWeight: typeFont[Math.floor(Math.random() * typeFont.length)]
      };
      circle.animationTo(options);
    }, 3000);
  
    // global configuration
    const globalConfig = {
      speed: 30,
      animationSmooth: "1s ease-out",
      strokeBottom: 5,
      colorSlice: "#FF6D00",
      colorCircle: "#f1f1f1",
      round: true
    };
  
    const global = new CircularProgressBar("global", globalConfig);
    global.initial();
  
    // update global example when change range
    const pieGlobal = document.querySelectorAll(".global");
    range.addEventListener("input", (e) => {
      pieGlobal.forEach((el, index) => {
        const options = {
          index: index + 1,
          percent: e.target.value
        };
        global.animationTo(options);
      });
    });
  
    document.querySelectorAll("pre code").forEach((el) => {
      hljs.highlightElement(el);
    });
  
    const infoCode = document.querySelectorAll(".info-code");
    infoCode.forEach((info) => {
      info.addEventListener("click", (e) => {
        e.target.closest("section").classList.toggle("show-code");
      });
    });
  });
  
  document.getElementById('edit-info').addEventListener('click', function() {
    const inputs = document.querySelectorAll('.editInfoModal input');
    inputs.forEach(function(input) {
        input.removeAttribute('readonly');
    });
});

document.getElementById('update-info').addEventListener('click', function() {
    const inputs = document.querySelectorAll('.editInfoModal input');
    inputs.forEach(function(input) {
        input.setAttribute('readonly', true);
    });
});


document.addEventListener('DOMContentLoaded', function() {
  const togglePassword = document.getElementById('toggle-password');
  const passwordInput = document.getElementById('password');
  const confirmPasswordInput = document.getElementById('confirmPassword');

  togglePassword.addEventListener('click', function() {
      const isVisible = passwordInput.type === 'text';

      // Toggle password visibility
      passwordInput.type = isVisible ? 'password' : 'text';
      confirmPasswordInput.type = isVisible ? 'password' : 'text';

      // Toggle eye icons
      togglePassword.querySelector('.closeEye').classList.toggle('d-none', !isVisible);
      togglePassword.querySelector('.ShowEye').classList.toggle('d-none', isVisible);
  });
});




