
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
