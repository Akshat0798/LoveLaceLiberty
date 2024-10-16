            <!-- Footer -->
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>Copyright &copy; {{config('app.name')}} 2024</span>
                    </div>
                </div>
            </footer>
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <a class="btn btn-primary" href="{{ route('logout') }}"  onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout</a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="{{ asset('public/admin_assets/vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('public/admin_assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

    <!-- Core plugin JavaScript-->
    <script src="{{ asset('public/admin_assets/vendor/jquery-easing/jquery.easing.min.js') }}"></script>

    <!-- Custom scripts for all pages-->
    <script src="{{ asset('public/admin_assets/js/sb-admin-2.min.js') }}"></script>
<script src="{{ asset('public/assets/js/custom.js') }}"></script>
    <!-- Page level plugins -->
    <!-- <script src="{{ asset('public/admin_assets/vendor/chart.js/Chart.min.js') }}"></script> -->

    <!-- Page level custom scripts -->
    <!-- <script src="{{ asset('public/admin_assets/js/demo/chart-area-demo.js') }}"></script>
    <script src="{{ asset('public/admin_assets/js/demo/chart-pie-demo.js') }}"></script> -->


    <!-- Page level plugins -->
    <script src="{{ asset('public/admin_assets/vendor/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('public/admin_assets/vendor/datatables/dataTables.bootstrap4.min.js') }}"></script>

    <!-- Page level custom scripts -->
    <script src="{{ asset('public/admin_assets/js/demo/datatables-demo.js') }}"></script>

    <script src="{{ url('public/admin_assets/vendor/bootstrap-datepicker/js/bootstrap-datepicker.min.js') }}"></script>
    <script src="{{ asset('public/admin_assets/js/summernote.min.js') }}"></script>
    
    
@yield('script')
<script type="text/javascript">
        $(document).ready(function(){
      /* set alert show*/
      setInterval(function(){
        $('.alert').hide();
      }, 4000);
           
      /* State change*/
      $(document).on('focus', '.changeStatus', function () {
        s_oldValue = $(this).val();
      });
      $(document).on('change', '.changeStatus', function () {
        var status = $(this).val();
        var id = $(this).attr('id');
        var path = $(this).attr('data-path');
        var url = path;
        if (confirm("{{ucfirst(trans('admin_lang.message_update_status'))}}")) {
          changeStatus(url, status, id);
        } else {
          $(this).val(s_oldValue);
        }
      });
      /*End state Change*/
      $(document).on('click','.del', function () {
        $(".loding_img").show();
        var msg=$(this).attr('data-msg');
        var base_url= $(this).data('base_url');
        var url = $(this).data('route');
     
        if (confirm((msg)?msg:"{{ucfirst(trans('admin_lang.message_delete'))}}")){
          var data = {'_token': '{{ csrf_token() }}'}
          deleteRecored(url,base_url,data);
          tables.ajax.reload();
          $(".loding_img").hide();
        }else{
          $(".loding_img").hide();
        }
      });
         
      $(document).on('click','.delete-cat', function () {
        $(".loding_img").show();
        var msg=$(this).attr('data-msg');
        var base_url= $(this).data('base_url');
        var url = $(this).data('route');
     
        if (confirm((msg)?msg:"{{ucfirst(trans('admin_lang.message_delete'))}}")){
          var data = {'_token': '{{ csrf_token() }}'}
          deleteRecored(url,base_url,data);
          tables.ajax.reload();
          $(".loding_img").hide();
        }else{
          $(".loding_img").hide();
        }
      });

      $(document).on('click','.paid', function () {
          var id=$(this).attr('id');
          var amount=$(this).attr('data-amount');
          var title = "Payment";
          var body = "<h4>Are you sure, You want to pay amount IQD "+amount + ".</h4>";
          $("#MyPopup .modal-title").html(title);
          $("#MyPopup .modal-body").html(body);
          $("#MyPopup .p_id").val(id);
          $("#MyPopup .p_amount").val(amount);
          $("#MyPopup").modal("show");
      });
    });

function myFunctionDelete() {
  var txt;
  var r = confirm("Are you sure remove this item ?");
  return r; 
}

function confirmation() {
            return confirm('Are you sure, you want to delete');
        }
</script>
</body>

</html>