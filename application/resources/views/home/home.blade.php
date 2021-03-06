<!DOCTYPE HTML>
<html lang="en">
<head>
	<title>TITLE</title>
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<meta charset="UTF-8">


	<!-- Font -->

	<link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500" rel="stylesheet">
	<!-- Stylesheets -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    {!! Html::style("assets/home/category-sidebar/css/bootstrap.min.css") !!}
    {!! Html::style("assets/home/common-css/ionicons.css") !!}
    {!! Html::style("assets/home/category-sidebar/css/styles.css") !!}
    {!! Html::style("assets/home/category-sidebar/css/responsive.css") !!}
    {!! Html::style("assets/home/category-sidebar/css/custom.css") !!}
<style type="text/css">
	.post-style-1 .blog-image {
    max-height: 300px;
    float: left;
    padding: 10px;
}
.blog-image img{
    width: 120px;
}
.card-img-top-250{
    text-align: center;
    background: #fff;
    padding: 10px;
}
.card-img-top-250 img{
    width: 176px;
    /*padding: 10px;*/
    border: 1px solid #ddd;
    border-radius: 5px;
}

.section {
    padding: 12px 0 40px;
}
.mgBottom {
    margin-bottom: 30px;
}
.ellipsis {
    overflow: hidden;
    white-space: nowrap;
    text-overflow: ellipsis;
}
</style>
<style type="text/css">
        .twitter-typeahead { width: 80%; } 
        

.tt-suggestion {
    padding: 3px 20px;
    font-size: 18px;
    line-height: 24px;
}

.tt-suggestion.tt-is-under-cursor { /* UPDATE: newer versions use .tt-suggestion.tt-cursor */
    color: #fff;
    background-color: #0097cf;

}
.card-text{
  height: 66px;
}
    </style>
</head>
<body >
@include('sub.top_menu')
	<section class="carousel slide" data-ride="carousel" id="postsCarousel" style="margin-top:10px">
    <div class="container">
        <div class="row">
            <div class="col-6 text-left mb-4">
                <h3>Truyện hot mới ra lò</h3>
            </div>
            <div class="col-6 text-right mb-4">
                <a class="btn btn-outline-secondary prev" href="" title="go back"><i class="fa fa-lg fa-chevron-left"></i></a>
                <a class="btn btn-outline-secondary next" href="" title="more"><i class="fa fa-lg fa-chevron-right"></i></a>
            </div>
        </div>
    </div>
    <div class="container p-t-0 m-t-2 carousel-inner" style="min-height:385px">
        <?php 
            $i=0;
            $u=0;
        ?>
        @foreach($newSlideShow as $item)
        <?php 
            if($i==0){
        ?>
        <div class="row row-equal carousel-item @if($u==0) active @endif m-t-0">
        <?php }?>
            <div class="col-md-3" style="margin-bottom: 10px">
                <div class="card">
                    <div class="card-img-top card-img-top-250">
                        <a href="{{url('detail/'.$item->id.'/'.$item->slug)}}" target="_blank"><img src="{{URL::asset('files/'.$item->folder_name.'/avatar/'.$item->img_avatar)}}" /></a>
                    </div>
                    <div class="card-block p-t-2">
                        <div class="card-header"><h3 class="ellipsis"><a href="{{url('detail/'.$item->id.'/'.$item->slug)}}" target="_blank">{{$item->title}}</a></h3></div>
                        <div class="card-text"><a href="{{url('view/'.$item->slug.'/chap-'.$item->total_chap)}}" target="_blank">{{$item->title}} Chap {{$item->total_chap}}</a></div>
                    </div>
                </div>
            </div>
        <?php 
            $i++;
            $u++;
        ?>
        <?php if($i==4){?>
        </div>
        <?php 
        $i=0;
        }
        ?>
        @endforeach
    </div>

</section>

	<section class="blog-area section">
		<div class="container">
			<div class="row">
                <div class="col-md-12"><h3>Truyện mới đăng</h3></div>
				<div class="col-lg-8 col-md-12">
					<div class="row" id="load-data">
                        <?php
                            use App\Models\TruyenChap;
                        ?>
                        @foreach($truyens as $itemt)
                        <?php
                            /*if($itemt->website_id==1 || $itemt->website_id==3){//blogtruyen
                              $truyenChap = TruyenChap::where('truyen_id',$itemt->id)->orderBy('title','desc')->take(8)->get();
                            }else {//truyentranh
                              $truyenChap = TruyenChap::where('truyen_id',$itemt->id)->orderBy('title','desc')->take(8)->get();
                            }*/
                            $truyenChap = TruyenChap::where('truyen_id',$itemt->id)->orderBy('title','desc')->take(8)->get();
                        ?>
						<div class="col-md-6 col-sm-12 mgBottom">
							<div class="card h-100">
								<div class="single-post post-style-1">

									<div class="blog-image"><a href="{{url('detail/'.$itemt->id.'/'.$itemt->slug)}}" target="_blank"><img src="{{URL::asset('files/'.$itemt->folder_name.'/avatar/'.$itemt->img_avatar)}}" alt="Blog Image">
                  </a>
                  </div>
									<div class="blog-info">

										<h4 class="title ellipsis"><a href="{{url('detail/'.$itemt->id.'/'.$itemt->slug)}}" target="_blank"><b>{{$itemt->title}}</b></a></h4>
										<div class="row" style="">
                                        <div class="col-xs-6" style="margin-right: 20px;margin-left: 20px">
                                          <div class="hotup-list">
                                            <?php
                                                $chapNumber=0;
                                            ?>
                                            @foreach($truyenChap as $item)
                                            @if($chapNumber<=3)
                                              <a class="latest-chap" href="{{url('view/'.$itemt->slug.'/chap-'.$item->chap_number)}}" target="_blank">Chap {{$item->chap_number}}</a>
                                              <br/>
                                            @endif
                                            <?php
                                                $chapNumber++;
                                            ?>
                                            @endforeach
                                                  </div>
                                        </div>
                                        <?php
                                                $chapNumber=0;
                                            ?>
                                        <div class="col-xs-6">
                                          <div class="hotup-list">
                                            @foreach($truyenChap as $item)
                                            @if($chapNumber<=7 && $chapNumber>3)
                                              <a class="latest-chap" href="{{url('view/'.$itemt->slug.'/chap-'.$item->chap_number)}}" target="_blank">Chap {{$item->chap_number}}</a>
                                              <br/>
                                            @endif
                                            <?php
                                                $chapNumber++;
                                            ?>
                                            @endforeach
                                                  </div>
                                        </div>

                                      </div>
										<ul class="post-footer">
											<!-- <li><a href="#"><i class="ion-heart"></i>57</a></li>
											<li><a href="#"><i class="ion-chatbubble"></i>6</a></li> -->
											<li><a href="#"><i class="ion-eye"></i>{{$itemt->total_view}}</a></li>
										</ul>

									</div><!-- blog-info -->
								</div><!-- single-post -->
							</div><!-- card -->
						</div><!-- col-md-6 col-sm-12 -->
                        @endforeach
                        @if($totalTruyen>8)
                        <div class="col-lg-8 col-md-12 offset-5" id="remove-row">
                            <button class="load-more-btn btn btn-info" id="btn-more" href="#" data-id="{{$itemt->id}}">LOAD MORE</button>
                        </div>
                        @endif
					</div><!-- row -->
                    
				</div><!-- col-lg-8 col-md-12 -->

				@include('sub.right_menu')

			</div><!-- row -->

		</div><!-- container -->
	</section><!-- section -->


	@include('sub.footer')
<input type="hidden" id="_url" value="{{url('/')}}">
	<!-- SCIPTS -->
    {!! Html::script("assets/home/common-js/jquery-3.1.1.min.js") !!}

	<!-- <script src="common-js/tether.min.js"></script> -->
  <script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-Token': $('input[name="_token"]').val()
        }
    });

    var _url=$('#_url').val();

</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.2/js/bootstrap.min.js" integrity="sha384-o+RDsa0aLu++PJvFqy8fFScvbHFLtbvScb8AjopnFD+iEQ7wo/CG0xlczd+2O/em" crossorigin="anonymous"></script>
  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/typeahead.js/0.11.1/typeahead.bundle.min.js"></script>
	<!-- <script src="common-js/scripts.js"></script> -->
  {!! Html::script("assets/js/truyen.js") !!}
	<script>
   (function($){
	   "use strict";
	   $('.next').click(function(){ $('.carousel').carousel('next');return false; });
	   $('.prev').click(function(){ $('.carousel').carousel('prev');return false; });
   })	
   (jQuery);
</script>
<script>
$(document).ready(function(){
   $(document).on('click','#btn-more',function(){
       var id = $(this).data('id');
       $("#btn-more").html("Loading....");
       $.ajax({
           url : '{{ url("pagingHome") }}',
           method : "GET",
           data : {id:id, _token:"{{csrf_token()}}"},
           dataType : "text",
           success : function (data)
           {
              if(data != '') 
              {
                  $('#remove-row').remove();
                  $('#load-data').append(data);
              }
              else
              {
                  $('#btn-more').html("No Data");
              }
           }
       });
   });  
}); 
</script>
<script>
            
        </script>
</body>
</html>
