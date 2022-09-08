@props([
    'companies' => [],
    'model' => null
])

<div class="mt-5 md:col-span-2 md:mt-0">
    <h3>Create Employee</h3>
    <form action="{{ $model ? route('employees.update', $model->id) : route('employees.store') }}"  method="POST">
        @csrf
        @if($model)
            @method('put')
        @endif
        <div>
            <x-input-label for="first_name" :value="__('First Name')" />

            <x-text-input class="block mt-1 w-full" type="text" name="first_name" id="first_name"
                          :value="old('first_name', $model?->first_name)" autofocus required />
        </div>

        <div>
            <x-input-label for="last_name" :value="__('Last Name')" />

            <x-text-input class="block mt-1 w-full" type="text" name="last_name" id="last_name"
                          :value="old('last_name', $model?->last_name)" autofocus required/>
        </div>

        <div>
            <x-input-label for="company_id" :value="__('Company')" />

            <x-input-select id="company_id" name="company_id"  :companies="$companies"  required="required"
                            :selected="old('copmany_id', $model?->company_id)"/>
        </div>

        <div class="mt-4">
            <div>
                <x-input-label for="email" :value="__('Email')" />

                <x-text-input id="email" class="block mt-1 w-full" type="text" name="email" :value="old('email', $model?->email)"/>
            </div>
        </div>

        <div class="mt-4">
            <div>
                <x-input-label for="phone_no" :value="__('Phone #')" />

                <x-text-input id="phone_no" class="block mt-1 w-full" type="text" name="phone_no" :value="old('phone_no', $model?->phone_no)" />
            </div>
        </div>

        <div class="flex items-center justify-end mt-4">

            <x-primary-button class="ml-3">
                {{$model ? 'Update' : 'Create'}}
            </x-primary-button>
        </div>
    </form>

</div>
