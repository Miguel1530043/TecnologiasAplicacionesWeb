<?php
	$mvc = new MvcController();
?>
<br>
<div class="row responsive">


    <div class="col s1"></div>
    <div class="col s10">
        <div class="col s6 responsive"> 
           <div class="col s12 m12">
                <div class="card horizontal">
                    <div class="card-image">
                        <img src="views/img/articulos.png">
                    </div>
                    <div class="card-stacked">
                        <div class="card-content">
                            <p style="font-size:20px">Articulos</p>
                        </div>
                        <div class="card-action">
                            <a class='pink accent-4 btn-large' href='index.php?action=articulos' >
                                Ver
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col s6">
          <div class="col s12 m12">
                <div class="card horizontal">
                    <div class="card-image">
                        <img src="views/img/ventas.png">
                    </div>
                    <div class="card-stacked">
                        <div class="card-content">
                            <p style="font-size:20px">Ventas</p>
                        </div>
                        <div class="card-action">
                            <a class='pink accent-4 btn-large' href='index.php?action=ventas' >
                                Ver
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col s6">
            <div class="col s12 m12">
                <div class="card horizontal">
                    <div class="card-image">
                        <img src="views/img/compras.png">
                    </div>
                    <div class="card-stacked">
                        <div class="card-content">
                            <p style="font-size:20px">Compras</p>
                        </div>
                        <div class="card-action">
                            <a class='pink accent-4 btn-large' href='index.php?action=compras' >
                                Ver
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col s6">
            <div class="col s12 m12">
                <div class="card horizontal">
                    <div class="card-image">
                        <img src="views/img/inventario.png">
                    </div>
                    <div class="card-stacked">
                        <div class="card-content">
                            <p style="font-size:20px">Inventario</p>
                        </div>
                        <div class="card-action">
                            <a class='pink accent-4 btn-large' href='index.php?action=inventario' >
                                Ver
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col s12">
            <div class="col s12 m12">
                <div class="card horizontal">
                    <div class="card-stacked">
                        <div class="card-content">
                            <div class="row">
                                <div class="col s9">
                                  <h4>Video-Explicación del Sistema (Código)</h4>  
                                </div>
                                <div class="col s3">
                                   <a onclick="link()" class="btn-large">Link del Video</a>
                                </div>
                            </div>
                        </div>
                        <div class="card-action">
                            <div class="video-container" >
                                <iframe height="200" width="500" src="//www.youtube.com/embed/ZZnhovr6GbY" ></iframe> 
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
    </div>
    <div class="col s1"></div>
</div>



<script type="text/javascript">
    function link(){
        M.toast({html: '<a href="https://www.youtube.com/watch?v=ZZnhovr6GbY&feature=youtu.be" target="_blank">https://www.youtube.com/watch?v=pyi0ZfuIIvo</a>'})
    }
</script>
