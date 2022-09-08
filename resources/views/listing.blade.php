
<x-app-layout>
    @php
        $route_name = Route::currentRouteName();
        $componentName = $route_name == 'companies.index' ? 'companyListing' :'employeeListing';
        $create_route = $route_name == 'companies.index' ? 'companies.create' : 'employees.create';
        $create_btn_text = $route_name == 'companies.index' ? 'Crate New Company' : 'Create New Employee'
    @endphp
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <a class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150"
                        href="{{ route($create_route) }}" class="btn btn-primary">{{$create_btn_text}}</a>
                    <x-dynamic-component :component="$componentName" class="mt-4" :listing="$listing"/>
                    {{ $listing->links() }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
