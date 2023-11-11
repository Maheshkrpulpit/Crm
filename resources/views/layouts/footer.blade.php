<footer class="footer">
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-6">
                ©
                <script>
                    document.write(new Date().getFullYear())
                </script>
                All Right reserved {{$business->business_title??''}}.
            </div>
            <div class="col-sm-6">
                <div class="text-sm-end d-none d-sm-block">
                    {{$business->footer??''}}
                </div>
            </div>
        </div>
    </div>
</footer>