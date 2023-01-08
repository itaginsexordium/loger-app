@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card  border-primary">
                    <div class="card-header">
                        <form class="input-group mb-3 ajax" action={{ route('home') }}>
                            <button class="btn btn-primary " type="submit" id="button-addon2">
                                <svg width="20" height="20" fill="currentColor"
                                    class="absolute left-3 top-1/2 -mt-2.5 text-slate-400 pointer-events-none group-focus-within:text-blue-500"
                                    aria-hidden="true">
                                    <path fill-rule="evenodd" clip-rule="evenodd"
                                        d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" />
                                </svg>
                            </button>
                            <input type="text" id="search" type="search" name="search" class="form-control"
                                placeholder="Поиск.... " value="{{ request()->search }}" aria-label="Recipient's username"
                                aria-describedby="button-addon2">
                        </form>
                    </div>
                    <div class="card-body" style="padding:0 ">
                        <table class="col-md-12 table  text-center" style="margin-bottom:0 ">
                            <thead class="">
                                <tr class="table-active">
                                    <th  class="col-md-1">#</th>
                                    <th class="col-md-4">@lang('defaults.name')</th>
                                    <th class="col-md-4">@sortablelink('ip', trans('defaults.ip')) </th>
                                    <th class="col-md-4">@sortablelink('a_time', trans('defaults.a_time'))</th>
                                </tr>
                            </thead>
                            <tbody class="table-striped">
                                @forelse ($logs as $log)
                                    <tr>
                                        <td>{{ $log->id }}</td>
                                        <td>{{ $log->name }}</td>
                                        <td>{{ $log->ip }}</td>
                                        <td>{{ $log->getTime() }}</td>
                                    </tr>

                                    @empty
                                    <tr class="no-data text-center">
                                        <td colspan="4">@lang('defaults.empty')</td>
                                    </tr>
                                @endforelse

                            </tbody>
                        </table>
                    </div>

                    <div class="card-footer">
                        {{ $logs->withQueryString()->links('pagination::bootstrap-5') }}</div>
                </div>
            </div>
        </div>
    @endsection
