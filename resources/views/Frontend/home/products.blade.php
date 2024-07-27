@extends('Frontend.layouts.master')
@section('content')


<style>
    

.item-pagination {
  font-family: Montserrat-Regular;
  font-size: 13px;
  color: #808080;
  width: 36px;
  height: 36px;
  border-radius: 50%;
  border: 1px solid #eeeeee;
  margin: 6px;
  padding:12px 
}

.item-pagination:hover {
  background-color: #222222;
  color: white;
}

.active-pagination {
  background-color: #222222;
    color: white;
}



</style>
   


    <div class="container" >
        <figure id="banner-figure" style="margin-top: 142px;"><a href="#"><img src="{{ asset('flower/img/slide.png') }}" class="img-responsive" alt="img-holiwood" width="100%"></a></figure>
        <div class="text-banner">
            
        </div>
    </div>
    <div class="container content">
        <div class="row">    
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="col-lg-8 col-md-6 col-sm-6 col-xs-6 show-side">
                    <button class="sp1 hidden-sm hidden-xs">Show Sidebar</button>
                    <button class="btn-hide hidden-sm hidden-xs">Hide Sidebar</button>
                    <button id="btn-list"><i class="fas fa-list"></i></button>
                    <button id="btn-grid"><i class="fas fa-th"></i></button>
                    <span class="sp2 hidden-xs">Showing 1 - 12 of 30 results</span>
                </div>
                <div class="col-lg-4 col-md-6 col-sm-6 col-xs-6 show-select">
                    <span class="hidden-xs">Show</span>
                        <select id="select-show" class="select">
                          <option value="12">12</option>
                          <option value="18">18</option>
                          <option value="30">30</option>
                        </select>
                    
                    <select id="select-default" class="select">
                          <option value="produc_name">Product Name</option>
                          <option value="sell_price">Price</option>
                        </select>
                </div>
            </div>
            <!-- sidebar -->
            <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12 sidebar" id="subCateWise" style="clear: left;">
                <div class="collapse navbar-collapse" id="mysidebar">
                <ul class="list-group list-1">
                    <li class="list-group-item">CATEGORIES</li>


                    @foreach($categories as $row)
                      <li class="list-group-item">
                        <a href="javascript:void(0)"  onclick="getProductByCategory('{{ $row->id }}')">{{ $row->name }}</a><button class="accordion"></button>
                        <ul class="panel">
                             @foreach($row->sub_category as $sub)
                            <li><a href="javascript:void(0)" onclick="getProductByCategory('{{ $row->id }}','{{ $sub->id }}')">{{ $sub->name }}</a></li>

                            @endforeach
                        </ul>
                    </li>
                    @endforeach
                </ul>
                <!--  -->
                <ul class="list-group list-2">
                    <li class="list-group-item">COLOR OPTIONS</li>
                    <li class="list-group-item list-item-2">
                        <div class="color-item">
                            <a href="#"><span id="color-1"></span></a>
                            <a href="#"><span id="color-2"></span></a>
                            <a href="#"><span id="color-3"></span></a>
                            <a href="#"><span id="color-4"></span></a>
                            <a href="#"><span id="color-5"></span></a>
                            <a href="#"><span id="color-6"></span></a>
                            <a href="#"><span id="color-7"></span></a>
                            <a href="#"><span id="color-8"></span></a>
                        </div>
                        
                    </li>
                    
                </ul>
                <!--  -->
              <!--   <ul class="list-group list-3">
                    <li class="list-group-item">SIZE OPTIONS</li>
                    <li class="list-group-item list-item-3"><a href="#">L</a><span>(15)</span></li>
                    <li class="list-group-item list-item-3"><a href="#">M</a><span>(09)</span></li>
                    <li class="list-group-item list-item-3"><a href="#">S</a><span>(12)</span></li>
                    <li class="list-group-item list-item-3"><a href="#">XL</a><span>(16)</span></li>
                </ul> -->
                <!--  -->
                <ul class="list-group list-4">
                    <li class="list-group-item">
                        PRINCE

                    </li>
                    <li class="list-group-item list-item-4">
                        <div id = "slider-3"></div>
                        <p class="range-p">
                         <input type = "text" id = "price">
                         <button>Filter</button>
                         </p>
                         <figure class="bg-input"></figure>
                    </li>
                </ul>
                <!--  -->
                <!-- <ul class="list-group list-3">
                    <li class="list-group-item">MANUFATURER</li>
                    <li class="list-group-item list-item-3"><a href="#">Consequat</a><span>(15)</span></li>
                    <li class="list-group-item list-item-3"><a href="#">Fermentum</a><span>(09)</span></li>
                    <li class="list-group-item list-item-3"><a href="#">Pellentestque</a><span>(12)</span></li>
                    <li class="list-group-item list-item-3"><a href="#">Sollicitudinl</a><span>(16)</span></li>
                </ul> -->
                <!--  -->
                <!-- <ul class="list-group list-3">
                    <li class="list-group-item">SUBCATEGORY</li>
                    <li class="list-group-item list-item-3"><a href="#">Gifts</a><span>(20)</span></li>
                    <li class="list-group-item list-item-3"><a href="#">Chocolates</a><span>(07)</span></li>
                    <li class="list-group-item list-item-3"><a href="#">Card</a><span>(30)</span></li>
                    <li class="list-group-item list-item-3"><a href="#">Candy</a><span>(18)</span></li>
                </ul> -->
            </div>
        </div>

            <div id="preloader">
                <div id="status">&nbsp;</div>
            </div>
            <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12 content-flower" id="product_list">
                
                    
            
                <!--  -->
            <!--     <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 pagi">
                    <ul class="pagination">
                        <li><a href="#">01</a></li>
                        <li><a href="#">02</a></li>
                        <li><a href="#">03</a></li>
                        <li><a href="#">04</a></li>
                        <li><a href="#"><img src="{{ asset('flower/img/Next.png')}}" class="img-responsive" alt="img-holiwood"></a></li>
                    </ul>
                </div> -->
            
            </div>


            <div class="pagi">
            <div  id="pagination-result" class="pagination flex-m flex-w p-t-26">
                        <!-- <a href="#" class="item-pagination flex-c-m trans-0-4 active-pagination">1</a>
                        <a href="#" class="item-pagination flex-c-m trans-0-4">2</a> -->

                        <input type="hidden" name="rowcount" id="rowcount" />
                    </div>
                </div>
                      <div style="border-bottom: #F0F0F0 1px solid;margin-bottom: 15px;display:none">
                            Pagination Setting:<br> 
                            <select name="pagination-setting" onChange="changePagination(this.value);"  class="pagination-setting" id="pagination-setting">
                            <option value="all-links" selected="">Display All Page Link</option>
                            <option value="prev-next">Display Prev Next Only</option>
                            </select>
                        </div>
            
    </div>
</div>


<style> 

/*loader*/
#preloader {
  position: fixed;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
 
  /* change if the mask should have another color then white */
  /*z-index: 99;*/
  /* makes sure it stays on top */
}

#status {
  width: 200px;
  height: 200px;
  position: absolute;
  left: 50%;
  /* centers the loading animation horizontally one the screen */
  top: 50%;
  /* centers the loading animation vertically one the screen */
  background-image: url('{{ asset('flower/img/loader.gif')}}');
  /* path to your loading animation */
  background-repeat: no-repeat;
  background-position: center;
  margin: -100px 0 0 -100px;
  /* is width and height divided by two */
}
</style>
@endsection
