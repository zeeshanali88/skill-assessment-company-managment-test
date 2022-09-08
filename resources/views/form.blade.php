<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
            <a href="{{ url('dashboard')}}"></a>
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <!-- Validation Errors -->
                    <x-auth-validation-errors class="mb-4" :errors="$errors" />
                    @php
                        $componentName = in_array(Route::currentRouteName(), ['companies.create', 'companies.edit']) ? 'companyForm' : 'employee-form';
                        $model = $model ?? null;
                        $companies = $companies ?? [];
                    @endphp
                    <x-dynamic-component :component="$componentName" :model="$model" :companies="$companies"/>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
