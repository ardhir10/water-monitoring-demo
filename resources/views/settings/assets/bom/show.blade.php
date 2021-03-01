
    <table class="table display responsive nowrap datatable2 table-bordered" id="">
        <thead class="thead-dark">
            <th width="2%">No</th>
            <th>Materials</th>
        </thead>
        <tbody>
            @php
                $no = 1;
            @endphp
            @foreach ($boms->materials as $item)
                <tr>
                <td>{{$no++}}</td>
                    <td>{{$item->name}}</td>
                </tr>
            @endforeach



        </tbody>
    </table>
