@extends('littleadm.layouts.app')

@section('content')
<section class="content-header">
    @include('littleadm.includes.crumb', [
        'crumb' => [
            ['title' => 'Menu Bulider', 'route' => 'littleadm.menubuilder']
        ]
    ])
</section>

<!-- Main content -->
<section class="content">
    <!-- Info boxes -->
    <div class="row">
        <div class="container">
            <button class="btn btn-success mb-2" onclick="$('#modelmenuadd').modal();" style="width: 100%;">Add</button>
            <!-- Button trigger modal -->

            <table class="table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Icon</th>
                        <th>Type</th>
                        <th>Name</th>
                        <th>Value</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($menuitems as $item)
                        <tr>
                            <td scope="row">{{$item->id}}</td>
                            <td title="{{$item->icon}}"><i class='{{$item->icon}}'></td>
                            <td>{{$item->type == 'dynamic' ? 'Dynamic' : $item->type == 'crud' ? 'Crud' : 'URL'}}</td>
                            <td>{{$item->name}}</td>
                            <td>{{$item->val}}</td>
                            <td class="row">
                                <button class="btn btn-primary" onclick="modifyItem({{$item->id}}, '{{$item->name}}', '{{$item->type}}', '{{$item->val}}', '{{$item->icon}}', '{{$item->permi ? $item->permi : ''}}')">
                                    <i class="fas fa-edit"></i> Edit
                                </button>
                                <form action="{{route('littleadm.menubuilder.delete', ['id' => $item->id])}}" method="post">
                                    @csrf
                                    <button type="submit" class="btn btn-danger ml-2">
                                        <i class="fas fa-trash-alt"></i> Delete
                                    </button>
                                </form>
                            </td>
                        </tr>                   
                    @endforeach
                </tbody>
            </table>

            <div class="modal fade" id="modelmenuitem" tabindex="-1" role="dialog" aria-labelledby="modelTitleId1"
                aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Modify Item</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <form method="POST" action="" id="updateform">
                            @csrf
                        <div class="modal-body">
                                <div class="container-fluid">
                                    <div class="form-group">
                                        <label for="nameup">Name:</label>
                                        <input type="text" name="name" id="nameup" class="form-control"
                                            placeholder="Name">
                                    </div>
                                    <div class="form-group">
                                        <label for="iconup">Icon:</label>
                                        <input type="text" name="icon" id="iconup" class="form-control"
                                            placeholder="Icon">
                                    </div>
                                    <div class="form-group">
                                        <label for="rolesup">Roles:</label>
                                        <input type="text" name="roles" id="rolesup" class="form-control" placeholder="Roles Explode By char (|). Leave Empty To Show In All Roles">
                                    </div>
                                    <div class="form-group">
                                        <label for="typeup">Type:</label>
                                        <select name="type" id="typeup" class="form-control">
                                            <option value="dynamic" id="dynup">Dynamic</option>
                                            <option value="crud" id="crudup">Crud</option>
                                            <option value="url" id="urlup">URL</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="valup">Value:</label>
                                        <input type="text" name="val" id="valup" class="form-control" placeholder="Value">
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary">Update</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="modal fade" id="modelmenuadd" tabindex="-1" role="dialog" aria-labelledby="modelTitleId1"
                aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Add Item</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <form method="POST" action="{{route('littleadm.menubuilder.store')}}">
                        <div class="modal-body">
                                @csrf
                                <div class="container-fluid">
                                    <div class="form-group">
                                        <label for="name">Name:</label>
                                        <input type="text" name="name" id="name" class="form-control" placeholder="Name">
                                    </div>
                                    <div class="form-group">
                                        <label for="icon">Icon:</label>
                                        <input type="text" name="icon" id="icon" class="form-control" placeholder="Icon">
                                    </div>
                                    <div class="form-group">
                                        <label for="roles">Roles:</label>
                                        <input type="text" name="roles" id="roles" class="form-control" placeholder="Roles Explode By char (|). Leave Empty To Show In All Roles">
                                    </div>
                                    <div class="form-group">
                                        <label for="type">Type:</label>
                                        <select name="type" id="type" class="form-control">
                                            <option value="dynamic">Dynamic</option>
                                            <option value="crud">Crud</option>
                                            <option value="url">URL</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="val">Value:</label>
                                        <input type="text" name="val" id="val" class="form-control" placeholder="Value">
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary">Save</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

</section>
<script>
    function modifyItem(id, name, type, value, icon, permis){
        document.getElementById('updateform').setAttribute('action', '{{route('littleadm.menubuilder.update', ['id' => 'holder'])}}'.replace('holder', id));
        document.getElementById('nameup').setAttribute('value', name);
        document.getElementById('iconup').setAttribute('value', icon);
        document.getElementById('rolesup').setAttribute('value', permis);
        if(type == "dynamic") document.getElementById('dynup').setAttribute('selected', true);
        else if(type == "crud") document.getElementById('crudup').setAttribute('selected', true);
        else document.getElementById('urlup').setAttribute('selected', true);
        document.getElementById('valup').setAttribute('value', value);
        $("#modelmenuitem").modal();
    }
</script>
@endsection