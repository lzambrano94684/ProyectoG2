{!! HTML::style('https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css') !!}
{!! HTML::style('https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/css/bootstrap.min.css') !!}
{!! HTML::style('https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.1.3/cropper.css') !!}

<div class="row">
    <div class="col-md-12">
        <div id="actions">
            <div class="form-group docs-buttons">
                <!-- <h3>Toolbar:</h3> -->
                <div class="btn-group-horizontal" role="group" aria-label="Vertical button group">
                    <button type="button" class="btn btn-primary" data-method="setDragMode" data-option="move"
                            title="Move">
            <span class="docs-tooltip" data-toggle="tooltip" title="Mover">
              <span class="fa fa-arrows"></span>
            </span>
                    </button>

                    <button type="button" class="btn btn-primary" data-method="zoom" data-option="0.1" title="Zoom In">
            <span class="docs-tooltip" data-toggle="tooltip" title="Aumentar">
              <span class="fa fa-search-plus"></span>
            </span>
                    </button>
                    <button type="button" class="btn btn-primary" data-method="zoom" data-option="-0.1"
                            title="Zoom Out">
            <span class="docs-tooltip" data-toggle="tooltip" title="Disminuir">
              <span class="fa fa-search-minus"></span>
            </span>
                    </button>

                    <button type="button" class="btn btn-primary" data-method="move" data-option="-10"
                            data-second-option="0" title="Move Left">
            <span class="docs-tooltip" data-toggle="tooltip" title="Mover hacia Izquierda">
              <span class="fa fa-arrow-left"></span>
            </span>
                    </button>
                    <button type="button" class="btn btn-primary" data-method="move" data-option="10"
                            data-second-option="0"
                            title="Move Right">
            <span class="docs-tooltip" data-toggle="tooltip" title="Mover hacia Derecha">
              <span class="fa fa-arrow-right"></span>
            </span>
                    </button>
                    <button type="button" class="btn btn-primary" data-method="move" data-option="0"
                            data-second-option="-10" title="Move Up">
            <span class="docs-tooltip" data-toggle="tooltip" title="Mover hacia Arriba">
              <span class="fa fa-arrow-up"></span>
            </span>
                    </button>
                    <button type="button" class="btn btn-primary" data-method="move" data-option="0"
                            data-second-option="10"
                            title="Move Down">
            <span class="docs-tooltip" data-toggle="tooltip" title="Mover hacia Abajo">
              <span class="fa fa-arrow-down"></span>
            </span>
                    </button>

                    <button type="button" class="btn btn-primary" data-method="rotate" data-option="-45"
                            title="Rotate Left">
            <span class="docs-tooltip" data-toggle="tooltip" title="Rotar (-45)">
              <span class="fa fa-rotate-left"></span>
            </span>
                    </button>
                    <button type="button" class="btn btn-primary" data-method="rotate" data-option="45"
                            title="Rotate Right">
            <span class="docs-tooltip" data-toggle="tooltip" title="Rotar (45)">
              <span class="fa fa-rotate-right"></span>
            </span>
                    </button>
                    <button type="button" class="btn btn-primary" data-method="scaleX" data-option="-1"
                            title="Flip Horizontal">
            <span class="docs-tooltip" data-toggle="tooltip" title="Voltear X">
              <span class="fa fa-arrows-h"></span>
            </span>
                    </button>
                    <button type="button" class="btn btn-primary" data-method="scaleY" data-option="-1"
                            title="Flip Vertical">
            <span class="docs-tooltip" data-toggle="tooltip" title="Voltear Y">
              <span class="fa fa-arrows-v"></span>
            </span>
                    </button>
                    <button type="button" class="btn btn-primary" data-method="crop" title="Crop">
            <span class="docs-tooltip" data-toggle="tooltip" title="Fijar">
              <span class="fa fa-check"></span>
            </span>
                    </button>
                    <button type="button" class="btn btn-primary clear" data-method="clear" title="Clear">
            <span class="docs-tooltip" data-toggle="tooltip" title="Limiar">
              <span class="fa fa-remove"></span>
            </span>
                    </button>
                    <button type="button" class="btn btn-primary" data-method="disable" title="Disable">
            <span class="docs-tooltip" data-toggle="tooltip" title="Deshabilitar">
              <span class="fa fa-lock"></span>
            </span>
                    </button>
                    <button type="button" class="btn btn-primary" data-method="enable" title="Enable">
            <span class="docs-tooltip" data-toggle="tooltip" title="Habilitar">
              <span class="fa fa-unlock"></span>
            </span>
                    </button>

                    <button type="button" class="btn btn-primary" data-method="reset" title="Reset">
            <span class="docs-tooltip" data-toggle="tooltip" title="Restablecer Cambios">
              <span class="fa fa-refresh"></span>
            </span>
                    </button>
                </div>


            </div><!-- /.docs-buttons -->
        </div>
    </div>
    <div class="col-md-12">
        <!-- <h3>Demo:</h3> -->
        <div class="img-container">
            <img src="{{ $ruta }}" alt="Picture">
        </div>
    </div>
</div>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"
        integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj"
        crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"
        integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN"
        crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"
        integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV"
        crossorigin="anonymous"></script>
{!! HTML::script('https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.1.3/cropper.js') !!}

<script type="text/javascript">
    window.onload = function () {

        'use strict';

        var Cropper = window.Cropper;
        var URL = window.URL || window.webkitURL;
        var container = document.querySelector('.img-container');
        var image = container.getElementsByTagName('img').item(0);
        var cropper = new Cropper(image, '', true);
        var originalImageURL = image.src;
        var uploadedImageType = 'image/jpeg';
        var uploadedImageURL;
        // Tooltip
        $('[data-toggle="tooltip"]').tooltip();

        // Buttons
        if (!document.createElement('canvas').getContext) {
            $('button[data-method="getCroppedCanvas"]').prop('disabled', true);
        }

        if (typeof document.createElement('cropper').style.transition === 'undefined') {
            $('button[data-method="rotate"]').prop('disabled', true);
            $('button[data-method="scale"]').prop('disabled', true);
        }


        actions.querySelector('.docs-buttons').onclick = function (event) {
            var e = event || window.event;
            var target = e.target || e.srcElement;
            var cropped;
            var result;
            var input;
            var data;

            if (!cropper) {
                return;
            }

            while (target !== this) {
                if (target.getAttribute('data-method')) {
                    break;
                }

                target = target.parentNode;
            }

            if (target === this || target.disabled || target.className.indexOf('disabled') > -1) {
                return;
            }

            data = {
                method: target.getAttribute('data-method'),
                target: target.getAttribute('data-target'),
                option: target.getAttribute('data-option') || undefined,
                secondOption: target.getAttribute('data-second-option') || undefined
            };

            cropped = cropper.cropped;

            if (data.method) {
                if (typeof data.target !== 'undefined') {
                    input = document.querySelector(data.target);

                    if (!target.hasAttribute('data-option') && data.target && input) {
                        try {
                            data.option = JSON.parse(input.value);
                        } catch (e) {
                            console.log(e.message);
                        }
                    }
                }
                switch (data.method) {
                    case 'rotate':
                        if (cropped) {
                            cropper.clear();
                        }

                        break;

                    case 'getCroppedCanvas':
                        try {
                            data.option = JSON.parse(data.option);
                        } catch (e) {
                            console.log(e.message);
                        }

                        if (uploadedImageType === 'image/jpeg') {
                            if (!data.option) {
                                data.option = {};
                            }

                            data.option.fillColor = '#fff';
                        }

                        break;
                }

                result = cropper[data.method](data.option, data.secondOption);
                switch (data.method) {
                    case 'rotate':
                        if (cropped) {
                            cropper.crop();
                        }

                        break;

                    case 'scaleX':
                    case 'scaleY':
                        target.setAttribute('data-option', -data.option);
                        break;

                    case 'getCroppedCanvas':
                        if (result) {
                            // Bootstrap's Modal
                            $('#getCroppedCanvasModal').modal().find('.modal-body').html(result);

                            if (!download.disabled) {
                                download.href = result.toDataURL(uploadedImageType);
                            }
                        }

                        break;

                    case 'destroy':
                        cropper = null;

                        if (uploadedImageURL) {
                            URL.revokeObjectURL(uploadedImageURL);
                            uploadedImageURL = '';
                            image.src = originalImageURL;
                        }

                        break;
                }

                if (typeof result === 'object' && result !== cropper && input) {
                    try {
                        input.value = JSON.stringify(result);
                    } catch (e) {
                        console.log(e.message);
                    }
                }
            }
        };

        document.body.onkeydown = function (event) {
            var e = event || window.event;

            if (!cropper || this.scrollTop > 300) {
                return;
            }

            switch (e.keyCode) {
                case 37:
                    e.preventDefault();
                    cropper.move(-1, 0);
                    break;

                case 38:
                    e.preventDefault();
                    cropper.move(0, -1);
                    break;

                case 39:
                    e.preventDefault();
                    cropper.move(1, 0);
                    break;

                case 40:
                    e.preventDefault();
                    cropper.move(0, 1);
                    break;
            }
        };
        $(".clear").trigger("click");
        $(document).ready(function () {
            $(".clear").trigger("click");
        });
    };
</script>
