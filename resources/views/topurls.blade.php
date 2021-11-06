@extends('templates.default')

@section('titlePage', 'Top 100 most accessed URLs')

@section('content')
    <h1>Top 100 URLs</h1>
    <div class="col-md-12">
        <table class="table">
            <thead>
                <tr>
                    <th>Id</th>
                    <th>Original URL</th>
                    <th>Shortened URL</th>
                    <th>Number of access</th>
                </tr>
            </thead>
            <tbody>
                @foreach($topUrls as $url)
                    <tr>
                        <td>{{ $url->id }}</td>
                        <td>{{ $url->original_url }}</td>
                        <td>{{ $url->shortened_url }}</td>
                        <td>{{ $url->access_count }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div><!-- -->
@endsection
