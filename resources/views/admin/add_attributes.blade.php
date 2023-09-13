@extends('admin.layouts.appadmin')
@section('content')
    <style>
        .images-preview-div img {
            padding: 10px;
            max-width: 100px;
        }
    </style>
    <!-- Form Start -->
    <div class="container-fluid pt-4 px-4">
        @if (count($errors) > 0)
            <div class="alert alert-danger">
                <strong>Whoops!</strong> There were some problems with your input.<br><br>
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
        <div class="row g-4">
            <div class="col-sm-12 col-xl-12">
                <div class="bg-light rounded h-100 p-4">
                    <div class="mb-3">
                        <label for="name">Attribute Name:</label>
                        <input type="text" id="attribute_name" placeholder="Enter Attribute Name" autocomplete="off">
                        <button id="add_name" >Add Attribute Name</button>
                    </div>
                    <div class="mb-3">
                        <label for="name">Attribute Value:</label>
                        <input type="text" id="attribute_value" placeholder="Enter Attribute Name" autocomplete="off">
                        <button id="add_value" >Add Attribute Value</button>
                    </div>
                    <div class="mb-3">
                        <select id="selectId">

                        </select>
                    </div>
                    <form action="{{ route('session.create') }}" method="GET">
                        @csrf
                        <input type="hidden" name="attr_name" id="attr_id" value="">
                        <input type="hidden" name="attribute_values" id="value_id" value="">
                        <button type="submit">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- Form End -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

    {{-- Attribute Function --}}

    <script>
        $(document).ready(function(){
            $("#add_name").click(function(){
                var name = $('#attribute_name').val();

                $("#attr_id").val(name);
                alert('Attrbute Created, Add Values');
             });
            var attributes = new Array();
            $("#add_value").click(function(){
            // var name = $('#attribute_name').val();
                var value =  $('#attribute_value').val();
                    optText = value;
                    optValue = value;
                    // alert(optValue);
                    $('#selectId').append(`<option value="${optValue}">${optText}</option>`);
                // alert(value);
                attributes.push(value);
                $("#value_id").val(attributes);
                $('#attribute_value').val('');
            // console.log(attributes);
            });





            // $(document).on('click', '#set_session', function(){
            //     $.ajax({
            //     url: "{{ route('session.create') }}",
            //     data: {'name': name,
            //             'value': optValue
            //             },
            //     type: 'get',
            //     success: function(response){
            //         console.log(response);
            //     }
            //     });
            // });
        });
        // var btnAddAttribute = document.querySelector('#btnAddAttribute');
        const btnAdd = document.querySelector('#btnAdd');
        const btnRemove = document.querySelector('#btnRemove');
        const sb = document.querySelector('#list');
        const name = document.querySelector('#name');
        // const attribute_name = document.querySelector('#attribute_name');

        // btnAddAttribute.onclick =(e)=>{
        //     alert('working');
        //     e.preventDefault();
        //     // validate the option
        //     if (attribute_name.value == '') {
        //         alert('Please enter attribute name.');
        //         return;
        //     }
        //     // create a new option
        //     const option = new Option(attribute_name.value, attribute_name.value);
        //     // add it to the list
        //     sb.add(option, undefined);

        //     // reset the value of the input
        //     attribute_name.value = '';
        //     attribute_name.focus();
        // }

        // btnAdd.onclick = (e) => {
        //     e.preventDefault();

        //     // validate the option
        //     if (name.value == '') {
        //         alert('Please enter the name.');
        //         return;
        //     }
        //     // create a new option
        //     const option = new Option(name.value, name.value);
        //     // add it to the list
        //     sb.add(option, undefined);

        //     // reset the value of the input
        //     name.value = '';
        //     name.focus();
        // };

        // // remove selected option
        // btnRemove.onclick = (e) => {
        //     e.preventDefault();

        //     // save the selected option
        //     let selected = [];

        //     for (let i = 0; i < sb.options.length; i++) {
        //         selected[i] = sb.options[i].selected;
        //     }

        //     // remove all selected option
        //     let index = sb.options.length;
        //     while (index--) {
        //         if (selected[index]) {
        //             sb.remove(index);
        //         }
        //     }
        // };
    </script>
@endsection
