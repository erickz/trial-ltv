@extends('templates.default')

@section('titlePage', 'Top 100 most accessed URLs')

@section('content')
    <h1>Top 100 URLs</h1>
    <div class="col-md-12">
        &nbsp;

        <div class="">
            <h3>URL Shortener:</h3>
            @if ($errors->hasBag('post') || session()->has('type'))
                <div class="alert alert-{{ $errors->hasBag('post') | session()->get('type') == 'error' ? 'danger' : 'success' }}">
                    {{ $errors->post->first('url') }}
                    {{ session()->get('message') }}
                </div>
            @endif
            <div>
                <form action="{{ route('adm.urls.post') }}" method="POST">
                    @csrf
                    <div class="form-group d-block col-md-6">
                        <div class="input-group">
                            <input type="text" class="form-control" name="url" placeholder="Enter the url">
                            <br />
                            <input type="submit" value="Send" class="btn btn-success" />
                        </div>
                    </div>
                </form>
            </div>
        </div>

        &nbsp;
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
