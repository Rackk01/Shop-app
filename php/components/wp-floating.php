<style>
    .float {
        position: fixed;
        width: 45px;
        height: 45px;
        bottom: 70px;
        right: 26px;
        background-color: #25d366;
        color: #FFF;
        border-radius: 50px;
        text-align: center;
        font-size: 30px;
        box-shadow: 2px 2px 3px #999;
        z-index: 100;
    }

    .my-float {
        margin-top: 9px;
        margin-left: 1px;
    }

    .float:hover,
    .float:focus {
        box-shadow: 2px 2px 5px #6cc673;
        color: #25d366;
        background-color: #c7fedf;
    }
</style>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
<a href="https://api.whatsapp.com/send?phone=<?php echo $whatsappEmpres; ?>&text=Hola%21%20Necesito%20m%C3%A1s%20informaci%C3%B3n%20sobre%20algunos%20productos...%20." class="float" target="_blank">
    <i class="fa fa-whatsapp my-float"></i>
</a>