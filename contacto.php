<?php include('plantillas/bootstrap.php'); ?> 

<?php include('plantillas/header.php'); ?>

<div class="container">
    <div class="row mt-2">

        <div class="col-sm-12 col-md-4 col-lg-4">
            <div class="mb-2">
                <img src="img/correo.png" alt="">
                <label> cremeriayabarrotesliz@gmail.com</label>
            </div>

            <div class="mb-2">
                <img src="img/red_social.png" alt="">
                <label> Correo eléctronico </label>
            </div>

            <div class="mb-2">
                <img src="img/whats.png" alt="">
                <label> Correo eléctronico </label>
            </div>

            <div class="mb-2">
                <img src="img/ubicacion.png" alt="">
                <label> Correo eléctronico </label>
            </div>

        </div>

        <div class="col-sm-12 col-md-4 col-lg-4">
            <div class="m-auto">
                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3734.2933540607046!2d-103.35790448559939!3d20.61689620708768!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x8428b2808dcece3d%3A0xc674958996b8b184!2sUniversidad%20Tecnol%C3%B3gica%20de%20Jalisco!5e0!3m2!1ses!2smx!4v1593701001376!5m2!1ses!2smx"  height="400" frameborder="0" style="border:0;" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe>
            </div>   
        </div>

        <div class="col-sm-12 col-md-4 col-lg-4 m-auto">
            <div style="border-top: .3rem solid rgb(224, 191, 3);" class="bg-light pt-0 p-4 ">
                <h5 class="text-center mb-4  font-weight-light">Comentarios o Sugerencias</h5>
                <form>
                    <div class="form-group">
                      <label for="correoComent">Correo electrónico</label>
                      <input type="email" class="form-control" id="correoComent">
                    </div>
                    <div class="form-group">
                      <label for="areaComent">Escribe tu comentario o sugerencia</label>
                      <textarea class="form-control" id="areaComent" rows="4"></textarea>
                    </div>
                </form>
            </div>
        </div>

    </div>
</div>



<?php include('plantillas/footerAdaptado.php'); ?> 