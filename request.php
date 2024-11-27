<?php

use app\helpers\sessionHelper;
use app\helpers\Validator;

include dirname(dirname(__DIR__)) . '/views/inc/header.php';

?>
<!-- Content wrapper -->
<div class="content-wrapper">
    <!-- Content -->
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="py-3 breadcrumb-wrapper">
		<span class="text-muted fw-light">تاکسی / </span>ثبت درخواست</h4>
      <div class="row"><div class="col-md-6">
      <div class="card"><div class="card-body">

        <?php
        sessionHelper::getFlash();

        ?>

			<form action="/taxis/request" method="POST">
 			   <div class="mb-3 mt-3">
			        <label for="first_name" class="form-label">نام:</label>
			        <input type="text" class="form-control" value="<?= $_SESSION['user_name'] ?>" disabled>
   			     <div class="valid-feedback"></div>
					<div class="invalid-feedback"></div>

			    </div>
			    <div class="mb-3 mt-3">
 			       <label for="last_name" class="form-label">نام خانوادگی:</label>
  			      <input type="text" class="form-control" value="<?= $_SESSION['user_lastName'] ?>" disabled>
    			    <div class="valid-feedback"></div>
					<div class="invalid-feedback"></div>

			    </div>

				<div class="mt-3">
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#fullscreenModal">
                          تعیین مبدا و مقصد
                        </button>

                        <!-- Modal -->
                        <div class="modal fade" id="fullscreenModal" tabindex="-1" style="display: none;" aria-hidden="true">
                          <div class="modal-dialog modal-fullscreen" role="document">
                            <div class="modal-content">
                              <div class="modal-body nopadding">



<link rel="stylesheet" href="https://static.neshan.org/sdk/openlayers/v8.1.0/neshan-sdk/v1.0.5/index.css" />
<script src="https://static.neshan.org/sdk/openlayers/v8.1.0/neshan-sdk/v1.0.5/index.js"></script>


  <style>
    #map {height: 100%;width: 100%;}
	/* div.map::after {
		content: "";
    display: block;
    width: 64px;
    height: 50px;
    position: absolute;
    top: calc(50% - 25px);
    left: calc(50% - 32px);
    z-index: 1;
    background: url(/assets/img/map/marker-icon-origin.png) top center no-repeat;
    background-size: contain;
}*/
.map_container {
    width: 100%;
    height: 100%;
}

.marker {
    display: block;
    position: absolute;
    top: calc(50% - 51px);
    left: calc(50% - 32px);
    z-index: 100;
}
.marker_point {
    display: block;
    width: 64px;
    height: 50px;
    z-index: 1000;
	transition: all 0.2s ease-out;
}
.marker_point.origin_point {
    background: url(/assets/img/map/marker-icon-origin.png) 0px 7px no-repeat;
    background-size: contain;
}
.marker_point.destination_point {
    background: url(/assets/img/map/marker-icon-destination.png) 0px 7px no-repeat;
    background-size: contain;
}
.marker_shadow {
    display: block;
    width: 25px;
    height: 25px;
    position: relative;
    bottom: 16px;
    MARGIN: AUTO;
    background: #0000001f;
    border-radius: 50%;
    z-index: -10;
	transition: all 0.2s ease-out;
}
.marker_shadow::after {
    content: "";
    display: block;
    width: 3px;
    height: 3px;
    position: relative;
    /* z-index: 10; */
    top: 48%;
    margin: auto;
    background: black;
    border-radius: 50%;
    transition: all 0.2s;
}
.marker.up .marker_point {
    transform: scale(0.8);
    transform-origin: top;
}
.marker.up .marker_shadow {
    width: 40px;
    height: 40px;
	bottom: 23px;
}

  </style>
  <div class="map_container">
  	<div class="marker"><div class="marker_point origin_point"></div><div class="marker_shadow"></div></div>
  	<div id="map" class="map"></div>
  </div>

  <script type="text/javascript">

    var exampleResponse = {
   "routes": []
    };


    var neshanMap = new ol.Map({
      target: 'map',
      key: 'web.cb1bf0f37cc84f52bb8244749a26796f',  // Get your own API Key on https://platform.neshan.org/panel
      maptype: 'dreamy',
      poi: false,
      traffic: false,
      view: new ol.View({
        center: ol.proj.fromLonLat([48.73709930024654,31.281076963928257]),
        zoom: 14
      })
    });


	neshanMap.on('movestart', function (e) {
    	$(".marker").addClass("up");
	});
	neshanMap.on('moveend', function (e) {
    	$(".marker").removeClass("up");
	});

	var cycle = 0;

	$('.modal').on('click', '.accept_originLoc', function() {
		window[cycle] = cycle++;
		/* center marker */
		var centerPoint = neshanMap.getView().getCenter();
		var lonLatCenterPoint = ol.proj.toLonLat(centerPoint);
		window.lonOrigin = lonLatCenterPoint;

		addMarerOrn(lonOrigin);
		
		var newpoint = [];
		newpoint[0] = lonOrigin[0];
		newpoint[1] = lonOrigin[1];
		
		newpoint[1] = newpoint[1] + 0.002;
		
		neshanMap.getView().animate({
			center: ol.proj.fromLonLat(newpoint),
			duration: 400,
		});


		var requestOptions = {
			method: 'GET',
			headers: {'api-key' : "service.9ca6639fb596429ca247a6dd4e88616a"},
			redirect: 'follow'
		};
			
		!async function(){
			var reverse_api_response = await fetch("https://api.neshan.org/v5/reverse?lat="+lonOrigin[1]+"&lng="+lonOrigin[0] , requestOptions)
			.then(response => response.json())
			.then(result => {return result;})
			.catch(error => console.log('error', error));

			$("input.originLoc").val(reverse_api_response["formatted_address"])
		}();

		$("#source_geo").val(lonOrigin);
		$(".marker_point").removeClass("origin_point");
		$(".marker_point").addClass("destination_point");
		$(".accept_originLoc").addClass("d-none");
		$(".accept_destinationLoc").removeClass("d-none");
		//  neshanMap.getView().setZoom('14')

	});

	$('.modal').on('click', '.accept_destinationLoc', function() {
		window[cycle] = cycle++;
		/* center marker */
		var centerPoint = neshanMap.getView().getCenter();
		var lonLatCenterPoint = ol.proj.toLonLat(centerPoint);
		var lonDestination = lonLatCenterPoint;
		
		addMarerDes(lonDestination);

		var requestOptions = {
			method: 'GET',
			headers: {'api-key' : "service.9ca6639fb596429ca247a6dd4e88616a"},
			redirect: 'follow'
		};
		
		!async function(){
			var exampleResponse = await fetch("https://api.neshan.org/v4/direction?type=car&origin=" + lonOrigin[1] + ","+lonOrigin[0] + "&destination=" + lonDestination[1] + "," + lonDestination[0] + "&avoidTrafficZone=false&avoidOddEvenZone=false&alternative=false&bearing=", requestOptions)
			.then(response => response.json())
			.then(result => {return result;})
			.catch(error => console.log('error', error));

			console.log(exampleResponse);
			$(".duration_txt").val(exampleResponse.routes[0]["legs"][0]["duration"]["text"] + " / " + exampleResponse.routes[0]["legs"][0]["distance"]["text"])
			
			var trackStyle = new ol.style.Style({
				stroke: new ol.style.Stroke({
				width: 6,
				color: "#250ECDCC",
				}),
			});

			var pointStyle = new ol.style.Style({
				image: new ol.style.Circle({
				fill: new ol.style.Fill({
					color: '#0077FF',
				}),
				stroke: new ol.style.Stroke({
					color: '#FFFFFF',
					width: 2
				}),
				radius: 5,
				}),
			});
	

			for (let k = 0; k < exampleResponse.routes.length; k++) {
				for (let j = 0; j < exampleResponse.routes[k].legs.length; j++) {
				for (let i = 0; i < exampleResponse.routes[k].legs[j].steps.length; i++) {

					step = exampleResponse.routes[k].legs[j].steps[i];

					route = new ol.format.Polyline().readGeometry(step["polyline"], {
					dataProjection: 'EPSG:4326',
					featureProjection: 'EPSG:3857',
					});

					point = new ol.Feature({
					geometry: new ol.geom.Point(ol.proj.fromLonLat(step["start_location"]))
					});

					point.setStyle(pointStyle);

					feature = new ol.Feature({
					type: 'route',
					geometry: route,
					});

					feature.setStyle(trackStyle);

					var vectorSource = new ol.source.Vector({
					features: [feature, point]
					});

					var vectorLayer = new ol.layer.Vector({
					source: vectorSource
					});

					neshanMap.addLayer(vectorLayer);

				}
				}
			}
			addMarerDes(lonDestination);
			addMarerOrn(lonOrigin);
		}();

		!async function(){
			var reverse_api_response = await fetch("https://api.neshan.org/v5/reverse?lat="+lonDestination[1]+"&lng="+lonDestination[0] , requestOptions)
			.then(response => response.json())
			.then(result => {return result;})
			.catch(error => console.log('error', error));

			//console.log(reverse_api_response["formatted_address"]);
			$("input.destinationLoc").val(reverse_api_response["formatted_address"])
		}();

		$(".details_trip").removeClass("d-none");


		$("#destination_geo").val(lonDestination);
		$(".marker").addClass("d-none");
		$(".accept_destinationLoc").addClass("d-none");
		$(".submit_direction").removeClass("d-none");
	});

		
	//neshanMap.getViewport().style.cursor = "pointer";
	

	
	neshanMap.on('click', function(event) {
		var point = neshanMap.getCoordinateFromPixel(event.pixel);
		var lonLat = ol.proj.toLonLat(point); 
		
		window[cycle] = cycle++;
		
		if (cycle == 1 ){
			window.lonOrigin = lonLat;
			addMarerOrn(lonOrigin);




			$("#source_geo").val(lonOrigin);
			$(".marker_point").removeClass("origin_point");
			$(".marker_point").addClass("destination_point");
			$(".accept_originLoc").addClass("d-none");
			$(".accept_destinationLoc").removeClass("d-none");

			var requestOptions = {
				method: 'GET',
				headers: {'api-key' : "service.9ca6639fb596429ca247a6dd4e88616a"},
				redirect: 'follow'
			};
			
			!async function(){
				var reverse_api_response = await fetch("https://api.neshan.org/v5/reverse?lat="+lonOrigin[1]+"&lng="+lonOrigin[0] , requestOptions)
				.then(response => response.json())
				.then(result => {return result;})
				.catch(error => console.log('error', error));

			 	//console.log(reverse_api_response["formatted_address"]);
				$("input.originLoc").val(reverse_api_response["formatted_address"])
			}();

		}
		
		if (cycle == 2 ){
			neshanMap.getViewport().style.cursor = "default";
			destinationLoc = lonLat;

			$("#destination_geo").val(destinationLoc);
			$(".marker").addClass("d-none");
			$(".accept_destinationLoc").addClass("d-none");
			$(".submit_direction").removeClass("d-none");

			var requestOptions = {
			method: 'GET',
			headers: {'api-key' : "service.9ca6639fb596429ca247a6dd4e88616a"},
			redirect: 'follow'
			};
			
			!async function(){
				var exampleResponse = await fetch("https://api.neshan.org/v4/direction?type=car&origin=" + lonOrigin[1] + ","+lonOrigin[0] + "&destination=" + destinationLoc[1] + "," + destinationLoc[0] + "&avoidTrafficZone=false&avoidOddEvenZone=false&alternative=false&bearing=", requestOptions)
				.then(response => response.json())
				.then(result => {return result;})
				.catch(error => console.log('error', error));

				console.log(exampleResponse);
				$(".duration_txt").val(exampleResponse.routes[0]["legs"][0]["duration"]["text"] + " / " + exampleResponse.routes[0]["legs"][0]["distance"]["text"])
				
				var trackStyle = new ol.style.Style({
				  stroke: new ol.style.Stroke({
					width: 6,
					color: "#250ECDCC",
				  }),
				});

				var pointStyle = new ol.style.Style({
				  image: new ol.style.Circle({
					fill: new ol.style.Fill({
					  color: '#0077FF',
					}),
					stroke: new ol.style.Stroke({
					  color: '#FFFFFF',
					  width: 2
					}),
					radius: 5,
				  }),
				});
		

				for (let k = 0; k < exampleResponse.routes.length; k++) {
				  for (let j = 0; j < exampleResponse.routes[k].legs.length; j++) {
					for (let i = 0; i < exampleResponse.routes[k].legs[j].steps.length; i++) {

					  step = exampleResponse.routes[k].legs[j].steps[i];

					  route = new ol.format.Polyline().readGeometry(step["polyline"], {
						dataProjection: 'EPSG:4326',
						featureProjection: 'EPSG:3857',
					  });

					  point = new ol.Feature({
						geometry: new ol.geom.Point(ol.proj.fromLonLat(step["start_location"]))
					  });

					  point.setStyle(pointStyle);

					  feature = new ol.Feature({
						type: 'route',
						geometry: route,
					  });

					  feature.setStyle(trackStyle);

					  var vectorSource = new ol.source.Vector({
						features: [feature, point]
					  });

					  var vectorLayer = new ol.layer.Vector({
						source: vectorSource
					  });

					  neshanMap.addLayer(vectorLayer);

					}
				  }
				}
					addMarerDes(destinationLoc);
					addMarerOrn(lonOrigin);
			}();

			!async function(){
				var reverse_api_response = await fetch("https://api.neshan.org/v5/reverse?lat="+destinationLoc[1]+"&lng="+destinationLoc[0] , requestOptions)
				.then(response => response.json())
				.then(result => {return result;})
				.catch(error => console.log('error', error));

			 	//console.log(reverse_api_response["formatted_address"]);
				$("input.destinationLoc").val(reverse_api_response["formatted_address"])
			}();

			$(".details_trip").removeClass("d-none");

		}
	
  });
  
	function addMarerDes (location) {
		// add Marker to the map
		var marker = new ol.Feature({
		  geometry: new ol.geom.Point(ol.proj.fromLonLat(location))
		});

		marker.setStyle(new ol.style.Style({
		  image: new ol.style.Icon({
			anchor: [0.5, 1],
			scale: 0.5,
			src: '/assets/img/map/marker-icon-destination.png'
		  })
		}));

		var vectorSource = new ol.source.Vector({
		  features: [marker]
		});

		var vectorLayer = new ol.layer.Vector({
		  source: vectorSource
		});

		neshanMap.addLayer(vectorLayer);

	}
  
	function addMarerOrn (location) {
		// add Marker to the map
		var marker = new ol.Feature({
		  geometry: new ol.geom.Point(ol.proj.fromLonLat(location))
		});

		marker.setStyle(new ol.style.Style({
		  image: new ol.style.Icon({
			anchor: [0.5, 1],
			scale: 0.5,
			src: '/assets/img/map/marker-icon-origin.png'
		  })
		}));

		var vectorSource = new ol.source.Vector({
		  features: [marker]
		});

		var vectorLayer = new ol.layer.Vector({
		  source: vectorSource
		});

		neshanMap.addLayer(vectorLayer);
	}
 
  </script>


                              </div>
                              <div class="modal-footer container">
							  <div class="container pt-2 text-center">
								<div class="row justify-content-md-center gap-3">
									<div class="btn btn-success accept_originLoc col-md-6">تأیید مبداء</div>
									<div class="btn btn-success accept_destinationLoc col-md-6 d-none">تأیید مقصد</div>
									<button type="button" class="btn submit_direction btn-primary col-md-6 d-none" data-bs-dismiss="modal">ثبت مسیر</button>
									<a href="./request" type="button" class="btn btn-label-secondary col-md-2">بازنشانی</a>
								</div>
								</div>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>

			<div class="details_trip d-none">		  
				<div class="mb-3 mt-3">
					<label for="source" class="form-label">مبدا (مثال: درب 1، ساختمان هاشم زاده، رمپ 1 ...) :</label>
					<input type="text" class="form-control originLoc <?= Validator::hasError('source') ?>" name="source" id="source">
					<div class="invalid-feedback"><?= Validator::error('source') ?></div>
				</div>
				<div class="mb-3 mt-3">
					<label for="destination" class="form-label">مقصد:</label>
					<input type="text" class="form-control destinationLoc <?= Validator::hasError('destination') ?>" name="destination" id="destination">
					<div class="invalid-feedback"><?= Validator::error('destination') ?></div>
				</div>

				<input type="hidden" value="" id="source_geo" name="source_geo">
				<input type="hidden" value="" id="destination_geo" name="destination_geo">

				<div class="mb-3 mt-3">
					<label for="estimated_time" class="form-label">زمان تقریبی سفر:</label>
						<input type="text" class="form-control duration_txt disabled <?= Validator::hasError('estimated_time') ?>" name="estimated_time" id="estimated_time" readonly >
						<div class="invalid-feedback"><?= Validator::error('estimated_time') ?></div>
				</div>
			</div>

				<div class="mb-3"> نوع سفر:
					<div class="form-check form-check-inline mt-3">
						<input name="inside_outside" class="form-check-input" type="radio" value="inside" id="inside" checked>
						<label class="form-check-label" for="inside">داخلی شرکت</label>
					</div>
					<div class="form-check form-check-inline mt-3">
						<input name="inside_outside" class="form-check-input" type="radio" value="outside" id="outside">
						<label class="form-check-label" for="outside">بیرون شرکت</label>
					</div>
				</div>

				<div class="mb-3 time_of_trip">درخواست برای:
					<div class="form-check form-check-inline mt-3">
						<input name="request_type" class="form-check-input" type="radio" value="urgent" id="urgent" checked>
						<label class="form-check-label" for="urgent">اکنون فوری</label>
					</div>
					<div class="form-check form-check-inline mt-3">
						<input name="request_type" class="form-check-input" type="radio" value="normal" id="another_time">
						<label class="form-check-label" for="another_time">زمانی دیگر</label>
					</div>
				</div>

				<!-- Datetime Picker-->
				<div class="col-md-6 col-12 mb-4 date_time_picker d-none">
					<label for="flatpickr-datetime" class="form-label">انتخاب تاریخ و ساعت درخواست خودرو:</label>
					<input NAME="for_time" type="text" class="form-control" placeholder="YYYY/MM/DD - HH:MM" id="flatpickr-datetime">
				</div>

				<div class="mb-3">خودرو درخواستی: 
					<div class="form-check form-check-inline mt-3">
						<input name="car_type" class="form-check-input" type="radio" value="sedan" id="sedan" checked>
						<label class="form-check-label" for="sedan">سواری</label>
					</div>
					<div class="form-check form-check-inline mt-3">
						<input name="car_type" class="form-check-input" type="radio" value="pickup" id="pickup">
						<label class="form-check-label" for="pickup">وانت</label>
					</div>
					<div class="form-check form-check-inline mt-3">
						<input name="car_type" class="form-check-input" type="radio" value="van" id="van">
						<label class="form-check-label" for="van">ون</label>
					</div>
				</div>

				<div class="form-check form-switch mb-2">
					<input type="hidden" name="request_one_or_two_way" value="one-way">
					<input name="request_one_or_two_way" class="form-check-input" type="checkbox" id="Roundtrip" value="two-way">
					<label class="form-check-label" for="Roundtrip">سفر رفت و برگشت</label>
				</div>
 			   <div class="mb-3 mt-3">
    			    <label for="description" class="form-label">توضیحات:</label>
   			     <textarea class="form-control <?= Validator::hasError('description') ?>" rows="2" name="description" id="description"></textarea>
    			    <div class="valid-feedback"></div>
   			     <div class="invalid-feedback"><?= Validator::error('description') ?></div>
  			  </div>
  			  
   			 <input type="hidden" name="_token" value="<?= sessionHelper::getFormToken('request', 'taxis') ?>">
   			 <button type="submit" class="btn btn-primary">ثبت درخواست</button>
			</form>

</div>
          </div>
        </div>
        </div>
        </div>



    <!-- Vendors JS -->
    <script src="/assets/vendor/libs/moment/moment.js"></script>
    <script src="/assets/vendor/libs/jdate/jdate.js"></script>
    <script src="/assets/vendor/libs/flatpickr/flatpickr-jdate.js"></script>
    <script src="/assets/vendor/libs/flatpickr/l10n/fa-jdate.js"></script>


  <!-- / Menu active style -->
  <script>
    jQuery("a[href='/taxis/request']").parent(".menu-item").addClass('active').parents('.menu-item').addClass('open');


	 
	const flatpickrDateTime = document.querySelector('#flatpickr-datetime');
	flatpickrDateTime.flatpickr({
		enableTime: true,
		locale: 'fa',
		altInput: true,
		altFormat: 'Y/m/d - H:i',
		disableMobile: true
	});

	jQuery(".time_of_trip").change(function() {
		if(this.checked) {
			$(".date_time_picker").toggleClass("d-none d-block");
		} else {
			$(".date_time_picker").toggleClass("d-block d-none");
		}
	});

  </script>
  <!-- / Menu active style -->

<?php  include dirname(dirname(__DIR__)) . '/views/inc/footer.php'; ?>