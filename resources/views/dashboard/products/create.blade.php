
<section class="content">

    <div class="box box-primary">

        <div class="box-header">
            <h3 class="box-title">@lang('site.add')</h3>
        </div><!-- end of box header -->

        <div class="box-body">

            {{-- @include('partials._errors') --}}
<form >
    <div class="form-group">
        <label>@lang('site.ar.name')</label>
        <input type="text" wire:model="name" class="form-control" value="" >
        @error('name')
        <div class="alert alert-danger">
             <span>{{ $message }}</span>
        </div>
        @enderror

    </div>
    <div class="form-group">
        <label>@lang('site.en.name')</label>
        <input type="text" wire:model="name_en" class="form-control" value="" >
        @error('name_en')
        <div class="alert alert-danger">
             <span>{{ $message }}</span>
        </div>
        @enderror
    </div>
    <div class="form-group">
        <label>@lang('site.ar.description')</label>

            <textarea type="text" wire:model="description" class="form-control" cols="30" rows="5"></textarea>
        @error('description')
        <div class="alert alert-danger">
             <span>{{ $message }}</span>
        </div>
        @enderror
    </div>
    <div class="form-group">
        <label>@lang('site.en.description')</label>
        <textarea type="text" wire:model="description_en" class="form-control" cols="30" rows="5"></textarea>
        @error('description_en')
        <div class="alert alert-danger">
             <span>{{ $message }}</span>
        </div>
        @enderror
    </div>
    <div class="form-group">
        <label>@lang('site.categories')</label>
        <select wire:model="category_id" class="form-control">
            <option value="">@lang('site.all_categories')</option>
            @foreach ($categories as $category)
                <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
            @endforeach
        </select>
        @error('category_id')
        <div class="alert alert-danger">
             <span>{{ $message }}</span>
        </div>
        @enderror
    </div>
    <div class="form-group">
        <label>@lang('site.image')</label>
        <input type="file" wire:model="image" class="image form-control ">
    </div>

    <div class="form-group">
        <img src="{{ asset('uploads/product_images/default.jpg') }}" style="width: 100px" class="image-preview img-thumbnail" alt="">
    </div>


    <div class="form-group">
        <label>@lang('site.purchase_price')</label>
        <input type="number" wire:model="purchase_price" step="0.01" class="form-control" >
        @error('purchase_price')
        <div class="alert alert-danger">
             <span>{{ $message }}</span>
        </div>
        @enderror
    </div>

    <div class="form-group">
        <label>@lang('site.sale_price')</label>
        <input type="number" wire:model="sale_price" step="0.01" class="form-control" >
        @error('sale_price')
        <div class="alert alert-danger">
             <span>{{ $message }}</span>
        </div>
        @enderror
    </div>

    <div class="form-group">
        <label>@lang('site.stock')</label>
        <input type="number" wire:model="stock" class="form-control" >
        @error('stock')
        <div class="alert alert-danger">
             <span>{{ $message }}</span>
        </div>
        @enderror
    </div>

    {{-- <input type="hidden" wire:model="cat_id"> --}}
    @if($updateMode)
    <div class="form-group">
        <button type="button" wire:click="submitForm_edit"  class="btn btn-primary"><i class="fa fa-plus"></i> @lang('site.update')</button>
    </div>
    @else
    <div class="form-group">
        <button type="button" wire:click="submitForm" class="btn btn-primary"><i class="fa fa-plus"></i> @lang('site.add')</button>
    </div>
    @endif
</form>







        </div><!-- end of box body -->

    </div><!-- end of box -->

</section>



