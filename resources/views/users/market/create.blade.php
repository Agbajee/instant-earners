@extends("newlook3.main")
@section('content')
<div class="content-wrapper">
    {{-- homepage contents --}}
    <div class="container">
        <form method="post" action="{{route('submitMarket')}}" enctype="multipart/form-data">
        @csrf
            <div class="row">
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header ">
                            <h1> Post Your Skill</h1>
                        </div>
                        <div class="card-body pt-0">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="bmd-label-floating">Product Name<span class="text-info">*</span></label>
                                        <input type="text" class="form-control" name="product_name" required>
                                    </div>
                                </div>

                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label class="bmd-label-floating ">Price</label>
                                        <input type="text" class="form-control" name="price" placeholder="Leave empty if no price">
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="bmd-label-floating">Category<span class="text-info">*</span></label>
                                        <select name="category" class="form-control" required>
                                            <option value="">Choose a category</option>
                                            @foreach ($market_category as $category )
                                            <option value="{{$category->id}}">{{$category->category_name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <h2>Contact Details</h2>
                            <div class="row mt-4">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="bmd-label-floating">Whatsapp</label>
                                        <input type="text" class="withdraw-activities form-control" name="whatsapp">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="bmd-label-floating">Instagram</label>
                                        <input type="text" class="withdraw-activities form-control" name="instagram">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="bmd-label-floating">Telegram</label>
                                        <input type="text" class="withdraw-activities form-control" name="telegram">
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="bmd-label-floating">Phone call</label>
                                        <input type="tel" class="withdraw-activities form-control" name="phone">
                                    </div>
                                </div>
                            </div>
                            
                            <div class="row mt-4">
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label for="">Description</label>
                                        <textarea name="description"></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="col-md-6">
                    <div class="card h-500">
                        <div class="card-header ">
                            <h5> Upload Product Image</h5>
                        </div>
                        <div class="card-body pt-0">
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label class="bmd-label-floating ">Product Image</label>
                                        <input type="file" class="form-control" id="file" name="image" accept="image/jpeg, image/png, image/jpg">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <button class="btn btn-primary btn-block">Upload Product</button>
            </div>
        </form>
    </div>
    {{-- homepage contents --}}
</div>
    @endsection
