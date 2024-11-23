
<footer class="py-4 bg-light mt-auto">
                    <div class="container-fluid px-4">
                        <div class="d-flex align-items-center justify-content-between small">
                            <div class="text-muted">Copyright &copy; <a href="<?=baseURL()?>"><?=config('app.name',"QuickPHP")?></a> <?=date('Y')?></div>
                            <div>
                                <a href="javascript:void(0)">Privacy Policy</a>
                                &middot;
                                <a href="javascript:void(0)">Terms &amp; Conditions</a>
                            </div>
                        </div>
                    </div>
                </footer>
            </div>
        </div>
        <form action="<?=url('logout')?>" method="post" id="LogoutForm"></form>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="<?=asset('admin/js/scripts.js')?>"></script>
        <script src="<?=asset('admin/js/datatable.js')?>"></script>
        <?php
        foreach ($staticFiles as $jsFile) {
            echo '<script src="'.$jsFile.'"></script>';
        }
        ?>
    </body>
</html>
