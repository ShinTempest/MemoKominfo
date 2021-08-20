@extends('layouts.admin')
@section('content')
<style>
    body {
        height: 100%;
        background-image:url('{{url('images/background_login.png')}}');
        background-repeat: no-repeat;
        background-attachment: fixed;
        background-size: cover;
    }

    .table .thead-blue th {
        color: #FEFAFA;
        background-color: #133C77;
        border-color: #dee2e6;
    }
</style>

<div class="content-page">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="font-weight-bold m-2" style="color: #0C355A">Monitoring Media</h1>
            </div>
            <div class="col-lg-4 mt-5 mb-3">
                <a href="{{ route('user.pelaporan.index')}}" class="btn btn-lapor item-center"><i class="fa fa-plus-circle" aria-hidden="true"></i> Tambah Laporan</a>
            </div>
        </div><br>
        <div class="card" style="background-color:#FFFFFF">
            <div class="card-header">
                Daftar Rekapitulasi
        </div>
        <div class="card-body" style="background-color:#F3F8FF">
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable datatable-User">
                <thead class="thead-blue">
                    <tr>
                        <th>
                            No
                        </th>
                        <th>
                            Judul
                        </th>
                        <th>
                            Dibuat Oleh
                        </th>
                        <th>
                            Tanggal
                        </th>
                        <th>
                            Waktu Pemantauan
                        </th>
                        <th>
                            Aksi
                        </th>
                    </tr>
                </thead>
                <tbody>
                
                @foreach($data as $datas)
                        <tr>
                        <td>
                            {{ ++$i}}
                        </td>
                        <td>
                            {{ $datas->judul_berita}}
                        </td>
                        @foreach($item = DB::table('role_user')->select('*')->where('user_id', $datas->user_id)->get() as $items)
                        @if($items -> role_id == 1)
                        <td>
                            Admin
                        </td>
                        @else
                        <td>
                            User
                        </td>
                        @endif
                        @endforeach
                        <td>
                            {{$datas -> created_at}}
                        </td>
                        <td>
                            {{$datas -> updated_at}}
                        </td>
                    
                        <td>
                            <a class="btn btn-xs btn-primary" href="{{ url('user/rekapitulasi-detail/'.$datas->id) }}">
                                {{ trans('global.view') }}
                            </a>

                            <a class="btn btn-xs btn-info" href="{{ url('user/rekapitulasi/'.$datas->id.'/edit')}}">
                                {{ trans('global.edit') }}
                            </a>

                            <form action="{{route('user.rekapitulasi.destroy', $datas->id)}}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
                                <input type="hidden" name="_method" value="DELETE">
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                <input type="submit" class="btn btn-xs btn-danger" value="{{ trans('global.delete') }}">
                            </form>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
        </div>
    </div>
</div>

@endsection

@section('scripts')
@parent
<script>
    $(function () {
    let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)

// @can('user_delete')
//   let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
//   let deleteButton = {
//     text: deleteButtonTrans,
//     url: "{{ route('admin.users.massDestroy') }}",
//     className: 'btn-danger',
//     action: function (e, dt, node, config) {
//       var ids = $.map(dt.rows({ selected: true }).nodes(), function (entry) {
//           return $(entry).data('entry-id')
//       });

//       if (ids.length === 0) {
//         alert('{{ trans('global.datatables.zero_selected') }}')

//         return
//       }

//       if (confirm('{{ trans('global.areYouSure') }}')) {
//         $.ajax({
//           headers: {'x-csrf-token': _token},
//           method: 'POST',
//           url: config.url,
//           data: { ids: ids, _method: 'DELETE' }})
//           .done(function () { location.reload() })
//       }
//     }
//   }
//   dtButtons.push(deleteButton)
// @endcan

  $.extend(true, $.fn.dataTable.defaults, {
    orderCellsTop: true,
    order: [[ 1, 'desc' ]],
    pageLength: 100,
  });
  let table = $('.datatable-User:not(.ajaxTable)').DataTable({ buttons: dtButtons })
  $('a[data-toggle="tab"]').on('shown.bs.tab', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
})

</script>
@endsection