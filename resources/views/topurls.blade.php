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
                    {!! session()->get('message') !!}
                </div>
            @endif
            <div>
                <form action="{{ route('adm.urls.post') }}" method="POST">
                    @csrf
                    <div class="form-check form-switch">
                        <input class="form-check-input" type="checkbox" name="nsfw" role="switch" id="flexSwitchNSFW">
                        <label class="form-check-label" for="flexSwitchNSFW">NSFW</label>
                    </div>
                    <div class="form-group d-block col-md-6">
                        <div class="input-group">
                            <input type="text" class="form-control" name="url" placeholder="Enter the url" value="{{ old('url') }}">
                            <input type="submit" value="Send" class="btn btn-success" />
                        </div>
                    </div>
                </form>
            </div>
        </div>

        &nbsp;
        <table class="table" id="listUrls">
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
                        <td><a href="{{ $url->original_url }}">{{ $url->original_url }}</a></td>
                        <td><a href="{{ $url->shortened_url }}" data-nsfw="{{ $url->nsfw }}" class="handlesNSFW">{{ $url->shortened_url }}</a></td>
                        <td>{{ $url->access_count }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div><!-- -->

    <div id="nsfwModal" class="modal" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">
                        <i class="fas fa-exclamation-circle text-warning"></i> This link is NSFW</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p class="text-center">
                        Wait to be redirected or click in the button to go straight away
                    </p>
                    <div id="countdown" class="fs-4 text-center mt-5 mb-4">
                        <div class="spinner-border text-warning" role="status">
                            <span class="visually-hidden">Loading...</span>
                        </div>
                        <div id="timer">
                            10 seconds
                        </div><!-- /imgHolder -->
                    </div><!-- /countdown -->
                </div>
                <div class="modal-footer">
                    <button type="button" data-bs-dismiss="modal"  class="btn btn-danger" data-bs-dismiss="modal">Cancel</button>
                    <a id="modalLinkRedirect" class="btn btn-success">Redirect now</a>
                </div>
            </div>
        </div>
    </div>
@endsection
