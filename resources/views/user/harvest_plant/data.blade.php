@foreach ($plants_list as $plant)
    <div class="col-6 col-sm-6 col-lg-3 mt-2 mt-md-0 mb-md-0 mb-2">
        <a href="#">
            <img class="w-100" src="{{ url($plant->image_url) }}" data-bs-toggle="modal" data-bs-target="#plantModal"
                data-plant="{{ base64_encode(json_encode($plant)) }}" style="border-radius: 6px;" />
        </a>
        <h5 class="text-subtitle text-center text-muted">{{ $plant->name }}</h5>
    </div>
@endforeach