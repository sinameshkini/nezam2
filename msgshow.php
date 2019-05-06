<?php
if(isset($_SESSION['msg'])) {
    if ($_SESSION['msg'] != "") { ?>
        <div class="alert mt-5
    <?php if ($_SESSION['msg_type']) {
            echo "alert-success";
        } else {
            echo "alert-danger";
        } ?> h4 text-center">
            <?php
            echo $_SESSION['msg'];
            $_SESSION['msg'] = "";
            ?>
        </div>
        <?php
    }
}
?>