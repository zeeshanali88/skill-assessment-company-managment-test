@props(["listing"])
<div class="flex flex-col">
    <div class="overflow-x-auto sm:-mx-6 lg:-mx-8">
        <div class="py-2 inline-block min-w-full sm:px-6 lg:px-8">
            <div class="overflow-hidden">
                <table class="w-full">
                    <thead class="bg-white border-b">
                    <tr>
                        <td class="text-sm font-medium text-gray-900 px-6 py-4 text-left">
                            First Name
                        </td>
                        <td class="text-sm font-medium text-gray-900 px-6 py-4 text-left">
                            Last Name
                        </td>
                        <td class="text-sm font-medium text-gray-900 px-6 py-4 text-left">
                            Company
                        </td>
                        <td class="text-sm font-medium text-gray-900 px-6 py-4 text-left">
                            Email
                        </td>
                        <td>
                            Phone Number
                        </td>
                        <td>
                            Actions
                        </td>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($listing as $key => $item)
                        <tr class="bg-gray-100 border-b">
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                {{$item->first_name}}
                            </td>
                            <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
                                {{$item->last_name}}
                            </td>
                            <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
                                {{$item->website ?? 'N/A' }}
                            </td>
                            <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
                                {{$item->company->name}}
                            </td>
                            <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
                                {{$item->email}}
                            </td>
                            <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap flex">
                                <a class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150"
                                   href="{{route('employees.edit', $item->id)}}">Edit</a>
                                <form method="post" action="{{route('employees.destroy', $item->id)}}">
                                    @csrf
                                    @method('delete')
                                    <x-primary-button class="ml-3">
                                        Delete
                                    </x-primary-button>
                                </form>

                            </td>
                        </tr>
                    @endforeach
                    @if (count($listing) == 0)
                        <tr class="bg-gray-100 border-b">
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900" colspan="6">
                               No data exists
                            </td>
                        </tr>
                    @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
