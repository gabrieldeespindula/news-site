<?php
// session
session_start();
if(isset($_SESSION['msg'])): 
    if($_SESSION['msg'] != "0"):?>

<script>
    // Toast msg js
    window.onload = function() {
        M.toast({html: '<?php echo $_SESSION['msg']; ?>' });
    }
</script>

<?php
    endif;
endif;$_SESSION['msg'] = "0";
?>