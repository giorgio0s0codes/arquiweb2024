<!doctype html>
<html lang="es">
    <head>
        <meta charset="utf-8">
        <title>Uso de jquery</title>
		<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" 
		      integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH"
			  crossorigin="anonymous">

        <script src="https://code.jquery.com/jquery-3.7.1.min.js" 
                integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" 
                crossorigin="anonymous">
        </script>
		<link href="./css/styles.css" rel="stylesheet">
    </head>
    <body>
       
		<div class="container-fluid">
			
			<section id="encabezado" class="row">
				<header class="col-12">
					<h1>Jquery</h1>
				</header>
			</section>
			
			<section id="principal" class="row">
			
			    <div id="navegacion" class="col-3 col-lg-2">
				
					
				
				</div>
				
				<div id="contenido" class="col-9 col-lg-10">

                    <div class="row h-100 p-5">
                        <div class="col-12 border border-info h-25 mt-5">

                        </div>
                        <p class="col-4 h-25 border border-warning-subtle d-flex align-items-center justify-content-center" >
                            <button type="button" class="btn btn-warning" data-id="100">Btn_1</button>
                        </p>
                        <p class="col-4 h-25 border border-warning-subtle d-flex align-items-center justify-content-center" >
                            <button type="button" class="btn btn-warning" data-id="200">Btn_2</button>
                        </p>
                        <p class="col-4 h-25 border border-warning-subtle d-flex align-items-center justify-content-center" >
                            <button type="button" class="btn btn-warning" data-id="300">Btn_3</button>
                        </p>

                        <div class="col-12 border border-info h-25">

                        </div>
                    </div>



                </div>
			</section>
		
		</div>
		
		<script src="js/jqSelectors.js" ></script>
		<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" 
		        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" 
		        crossorigin="anonymous">
		</script>
    </body>
</html>