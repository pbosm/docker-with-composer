<?php if ($_SERVER['REQUEST_URI'] != '/' && $_SERVER['REQUEST_URI'] != '/loginAccess' && $_SERVER['REQUEST_URI'] != '/register')  : ?>
    <!-- Footer Start -->
    <div class="footer-content container-fluid pt-4 px-4">
        <div class="rounded-top p-4" style="background-color: antiquewhite;">
            <div class="row">
                <div class="col-12 col-sm-6 text-center text-sm-start">
                    &copy; <a href="https://github.com/pbosm">Pablo Dev</a>, All Right Reserved.
                </div>
                <div class="col-12 col-sm-6 text-center text-sm-end">
                    <!--/*** This template is free as long as you keep the footer author’s credit link/attribution link/backlink. If you'd like to use the template without the footer author’s credit link/attribution link/backlink, you can purchase the Credit Removal License from "https://htmlcodex.com/credit-removal". Thank you for your support. ***/-->
                    Designed By <a href="">Pablo</a>
                    <!-- <br>Distributed By: <a href="" target="_blank">ThemeWagon</a> -->
                </div>
            </div>
        </div>
    </div>
    <!-- Footer End -->
</div>
<!-- Content End -->
<?php endif; ?>

<script>
    const URL_API  = '<?= URL_API ?>';
    const ROOT     = '<?= ROOT ?>';
</script>

<script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.3/jquery.validate.min.js"></script>
<script type="text/javascript" src="<?= ROOT ?>src/js/service/api.js"></script>
<script type="text/javascript" src="<?= ROOT ?>src/js/script.js"></script>
