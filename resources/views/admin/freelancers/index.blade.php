@extends('layouts.master')

@section('content')

    @component('components.dashboard-layout', [
        'title' => __('pages.freelancers'),
        'link' => route('admin.freelancers.create'),
    ])
        <div
            class="rounded-sm border border-stroke bg-white px-5 pt-6 pb-2.5 shadow-default dark:border-strokedark dark:bg-boxdark sm:px-7.5 xl:pb-1">
            <div class="max-w-full overflow-x-auto">
                <table class="w-full table-auto">
                    <thead>
                        <tr class="bg-gray-2 text-left dark:bg-meta-4">
                            <th class="min-w-[220px] py-4 px-4 font-medium text-right text-black dark:text-white xl:pl-11">
                                نام - نام خانوادگی
                            </th>
                            <th class="min-w-[150px] py-4 px-4 font-medium text-right text-black dark:text-white">
                                سن
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
                                        <div class="flex items-center gap-2">
                                            <img src="{{ $row->avatar ? '/uploads/' . $row->avatar : '/images/avatar.jpg' }}" class="w-24">
                                            <p class="text-sm">{{ $row->nick_name ?? '' }}</p>
                                        </div>
                                    </td>
                                    <td class="border-b border-[#eee] py-5 px-4 dark:border-strokedark">
                                        <p class="text-black dark:text-white">{{ $row->age }} سال</p>
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
                                        @include('partials.operation', [
                                            'removeLink' => route('admin.freelancers.remove', ['id' => $row->id]),
                                            'editLink' => route('admin.freelancers.show', ['id' => $row->id]),
                                        ])
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
