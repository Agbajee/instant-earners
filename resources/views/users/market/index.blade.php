@extends('newlook3.main')
@section('content')
<div class="content-page">
	<div class="content">

	<!-- Start Content-->
    <div class="content-wrapper">
      <div class="container-full">
          <!-- Main content -->
          <section class="content">
            <div class="row">
              <div class="col-xl-12 col-lg-12 col-12">
              <div class="box">
                <div class="box-header with-border">
                  <h4 class="box-title">My Products</h4>
                  <a href="{{route('createMarket')}}" class="btn btn-primary ms-2">Add New Product</a>
                </div>
                <div class="box-body">
                  <div class="table-responsive">

                    <table class="table table-lg table-striped invoice-archive">
                      <thead>
                        <tr>
                          <th>Image</th>
                          <th>Name</th>
                          <th>Likes</th>
                          <th>Category</th>
                          <th>Status</th>
                          <th>Action</th>
                        </tr>
                      </thead>
                      <tbody>
                        @forelse($products as $product)
                        <tr>
                          <td>
                            {{ date('d/m/y  g:i A',strtotime($product->created_at)) }}
                          </td>
                          <td>
                            <span class="badge badge-pill badge-secondary">{{ $product->product_name }}</span>
                          </td>
                          <td>
                            <h6 class="mb-0 fw-bold">{{ number_format($product->likes) }} </h6>
                          </td>
                          <td>
                            <h6 class="mb-0 fw-bold">{{ $market_category->find($product['cat_id'])->category_name }} </h6>
                          </td>
                          <td>
                            <h6 class="mb-0 fw-bold">{!! $product->status == '1' ? '<span class="badge badge-success">approved</span>': '<span class="badge badge-warning">pending</span>' !!} </h6>
                          </td>
                          <td>
                            <button class="edit-product waves-effect waves-light btn btn-primary-light"
                                data-id="{{$product->id}}"
                                data-name="{{$product->product_name}}"
                                data-image="{{$product->image}}"
                                data-description="{{$product->description}}"
                                data-price="{{$product->price}}"
                                data-whatsapp="{{$product->contact['whatsapp']}}"
                                data-instagram="{{$product->contact['instagram']}}"
                                data-telegram="{{$product->contact['telegram']}}"
                                data-phone="{{$product->contact['phone']}}"
                                >
                                <i data-feather="settings"></i>
                            </button>
                            <a href="{{route('userDeleteProduct', $product->id)}}" class="waves-effect waves-light btn btn-danger-light"><i data-feather="trash"></i></a>
                          </td>
                        </tr>
                        @empty
                        <tr>
                            <h4>You do not have any product</h4>
                            <a href="{{route('createMarket')}}" class="btn btn-primary-light">Add New</a>
                        </tr>
                        @endforelse

                      </tbody>
                    </table>

                  </div>
                </div>
              </div>
            </div>
            </div>
          </section>

      </div>
    </div>

    <div class="modal fade " id="editProduct" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <form class="form-element " action="{{route('userEditProduct')}}" method="post" >
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title" id="staticBackdropLabel">Editing-<span class="title"></span> </h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>

                    <div class="modal-body px-4">
                        <div class="row">
                            <div class="col-lg-12">
                                <input type="hidden" class="product-id" value="" name="id">

                                <div class="form-group row">
                                    <label class="col-sm-2 form-label">Price</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control product-price" name="price" value="" required autocomplete="off"/>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-sm-2 form-label">Category</label>
                                    <div class="col-sm-10">
                                        <select name="category" class="form-control" required>
                                            <option value=" " selected>Select New Category</option>
                                            @foreach ( $market_category as $cat )
                                            <option value="{{$cat->id}}">{{$cat->category_name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <hr>
                                <h3>Contact Info</h3>

                                <div class="row">
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label>Whatsapp</label>
                                            <input type="text" class="form-control whatsapp" name="whatsapp" value="" required autocomplete="off"/>
                                        </div>

                                    </div>

                                    <div class="col-6">
                                        <div class="form-group">
                                            <label>Instagram</label>
                                            <input type="text" class="form-control instagram" name="instagram" value="" required autocomplete="off"/>
                                        </div>
                                    </div>

                                </div>


                                <div class="row">
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label>Telegram</label>
                                            <input type="text" class="form-control telegram" name="telegram" value="" required autocomplete="off"/>
                                        </div>
                                    </div>

                                    <div class="col-6">
                                        <div class="form-group">
                                            <label>Phone</label>
                                            <input type="text" class="form-control phone" name="phone" value="" required autocomplete="off"/>
                                        </div>
                                    </div>
                                </div>

                                <hr>
                                <div class="form-group row">
                                    <label class="col-sm-2 form-label">Description </label>
                                    <div class="col-sm-10 ">
                                        <textarea class="form-control  description" name="description" required></textarea>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save Changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection
@section('js')
    <script>
        "user strict";
        (function ($) {
            $('.edit-product').on('click', function (){
                var modal = $('#editProduct');
                modal.find('.product-id').val($(this).data('id'));
                modal.find('.description').val($(this).data('description'));
                modal.find('.product-price').val($(this).data('price'));
                modal.find('.whatsapp').val($(this).data('whatsapp'));
                modal.find('.telegram').val($(this).data('telegram'));
                modal.find('.instagram').val($(this).data('instagram'));
                modal.find('.phone').val($(this).data('phone'));
                modal.find('.title').html($(this).data('name'));

                modal.modal('show');

            });
        })(jQuery);
    </script>
@stop
