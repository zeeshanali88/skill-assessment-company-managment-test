@props([
    'model' => null
])

<div class="mt-5 md:col-span-2 md:mt-0">
    <h3>Create company</h3>
    <form method="POST" action="{{ $model ? route('companies.update', $model->id) : route('companies.store') }}" enctype="multipart/form-data">
        @csrf
        @if($model)
            @method('put')
        @endif
        <div>
            <x-input-label for="email" :value="__('Name')" />

            <x-text-input class="block mt-1 w-full" type="text" name="name" :value="old('name', $model?->name)" autofocus />
        </div>

        <div class="mt-4">
            <div>
                <x-input-label for="email" :value="__('Email')" />

                <x-text-input id="email" class="block mt-1 w-full" type="text" name="email" :value="old('email', $model?->email)"/>
            </div>
        </div>

        <div class="mt-4">
            <div>
                <x-input-label for="email" :value="__('Website')" />

                <x-text-input id="email" class="block mt-1 w-full" type="text" name="website" :value="old('website', $model?->website)" />
            </div>
        </div>

        <div class="mt-4">
            <div>
                <x-input-label for="email" :value="__('Logo')" />
                <input type="file" name="logo">
                @if(isset($model->logo))
                    <img src="{{ asset($model->logo) }}" width="100" height="100" class="mt-2" />
                @endif
            </div>
        </div>

        <div class="flex items-center justify-end mt-4">

            <x-primary-button class="ml-3">
                {{$model ? 'Update' : 'Create'}}
            </x-primary-button>
        </div>
    </form>

</div>
