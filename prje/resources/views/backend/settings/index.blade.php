@extends('backend.layouth')
@section('content')
    <section class="content-header">

        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">Settings</h3>
            </div>
            <div class="box-body">
                <table class="table table-striped">
                    <thead>
                    <tr>
                        <th>Id</th>
                        <th>Açıklama</th>
                        <th>İçerik</th>
                        <th>Anahtar Değer</th>
                        <th>Type</th>
                        <th></th>
                        <th></th>
                    </tr>
                    <tbody id="sortable">
                    @foreach($data['adminSettings'] as $adminSettings)
                        <tr id="item-{{$adminSettings->id}}">
                            <td>{{$adminSettings->id}}</td>
                            <td class="sortable">{{$adminSettings['settings_description']}}</td>
                            <td>

                                @if($adminSettings['settings_type']=="file")
                                    <img width="100" src="../../images/settings/{{$adminSettings['settings_value']}}" alt="">
                                @else
                                    {{$adminSettings->settings_value}}
                                @endif
                            </td>
                            <td>{{$adminSettings->settings_key}}</td>
                            <td>{{$adminSettings->settings_type}}</td>
                            <td width="5"><a href="{{route('settings.Edit',['id'=>$adminSettings->id])}}"><i class="fa fa-pencil-square"></i></a></td>
                            <td width="5"
                                @if($adminSettings -> settings_delete)
                            ><a href="javascript:void(0)"><i id="{{$adminSettings->id}}" class="fa fa-trash-o"></i></a>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                    </tbody>

                </table>
            </div>
        </div>
    </section>


    <script type="text/javascript">
        $(function sortable(){

            $.ajaxSetup({
                headers:{
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $('#sortable').sortable({
                revert: true,
                handle: ".sortable",
                stop: function (event, ui) {
                    var item = $(this).sortable('serialize');
                    $.ajax({
                        type: "POST",
                        data:item,
                        url: "{{route('settings.Sortable')}}",
                        success: function (msg) {
                            // console.log(msg);
                            if (data) {
                                alert("işlem başarılı");
                            } else {
                                alert("işlem başarısız");
                            }
                        }
                    });

                }
            });
            $('#sortable').disableSelection();
            $(".fa-trash-o").click(function (){
                destroy_id=$(this).attr('id');
                alertify.confirm('Silme işlemini onaylıyacakmısınız','Bu işlem Geri alınamaz',
                function (){
                    location.href="settings/delete/"+destroy_id
                },
                function (){
                    alertify.error();
                }
                );
            })
        });
    </script>



@endsection
@section('css')@endsection
@section('js')@endsection
