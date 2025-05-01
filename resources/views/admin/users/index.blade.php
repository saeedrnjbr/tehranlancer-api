@extends('layouts.master')

@section('content')

    @component('components.dashboard-layout', [
        'title' => __('pages.users'),
        'link' => route('admin.users.create'),
    ])
        <div
            class="rounded-sm border border-stroke bg-white px-5 pt-6 pb-2.5 shadow-default dark:border-strokedark dark:bg-boxdark sm:px-7.5 xl:pb-1">
            <div class="max-w-full overflow-x-auto">
                <table class="w-full table-auto">
                    <thead>
                        <tr class="bg-gray-2 text-left dark:bg-meta-4">
                            <th class="min-w-[220px] py-4 px-4 font-medium text-right text-black dark:text-white xl:pl-11">
                                تلفن همراه
                            </th>
                            <th class="min-w-[220px] py-4 px-4 font-medium text-right text-black dark:text-white xl:pl-11">
                                نوع
                            </th>
                            <th class="min-w-[150px] py-4 px-4 font-medium text-right text-black dark:text-white">
                                تاریخ ایجاد
                            </th>
                            <th class="min-w-[120px] py-4 px-4 font-medium text-right text-black dark:text-white">
                                وضعیت
                            </th>
                            <th class="py-4 px-4 font-medium text-black  text-right dark:text-white">
                                عملیات
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @if ($rows->isNotEmpty())
                            @foreach ($rows as $row)
                                <tr>
                                    <td class="border-b border-[#eee] py-5 px-4 pl-9 dark:border-strokedark xl:pl-11">
                                        <h5 class="font-medium text-black dark:text-white">{{ $row->mobile }}</h5>
                                        <p class="text-sm">{{ $row->nick_name ?? "" }}</p>
                                    </td>
                                    <td class="border-b border-[#eee] py-5 px-4 dark:border-strokedark">
                                        <p class="text-black dark:text-white">{{ __('pages.' . $row->user_type) }}</p>
                                    </td>
                                    <td class="border-b border-[#eee] py-5 px-4 dark:border-strokedark">
                                        <p class="text-black dark:text-white">{{ $row->created_at_fa }}</p>
                                    </td>
                                    <td class="border-b border-[#eee] py-5 px-4 dark:border-strokedark">
                                        @include('partials.status', [
                                            'status' => $row->is_active,
                                        ])
                                    </td>
                                    <td class="border-b border-[#eee] py-5 px-4 dark:border-strokedark">
                                        @if ($row->id != 1)
                                            @include('partials.operation', [
                                                'removeLink' => route('admin.users.remove', ['id' => $row->id]),
                                                'editLink' => route('admin.users.show', ['id' => $row->id]),
                                            ])
                                        @else
                                            <span>-</span>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        @endif
                    </tbody>
                </table>

                <div class="p-4 navigation">
                    {{ $rows->links() }}
                </div>

            </div>
        </div>
    @endcomponent

@endsection
