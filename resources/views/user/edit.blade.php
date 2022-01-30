<x-app-layout>
  {{-- <x-slot name="header">
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">
          {{ __('釣りスタ') }}
      </h2>
  </x-slot> --}}

      @if ($errors->any())
      <div class="alert alert-danger">
          <ul>
              @foreach ($errors->all() as $error)
                  <li>{{ $error }}</li>
              @endforeach
          </ul>
      </div>
      @endif

      <form action="{{ route('posts.update', ['post' => $post->id]) }}" enctype="multipart/form-data" method="post">
      @csrf
      @method('put')
      <section class="text-gray-600 body-font relative z-0">
        <div class="container px-5 py-24 mx-auto">
          <div class="flex flex-col text-center w-full mb-12">
            <h1 class="sm:text-3xl text-2xl font-medium title-font mb-4 text-gray-900">編集画面</h1>
            <p class="lg:w-2/3 mx-auto leading-relaxed text-base">編集したい内容を入力してください。</p>
          </div>
          <div class="lg:w-1/2 md:w-2/3 mx-auto">
            <div class="flex flex-wrap -m-2">
              <div class="p-2 w-full">
                <div class="relative">
                  <label for="caption" class="leading-7 text-sm text-gray-600">キャプションを書く</label>
                  <textarea id="caption" name="caption" class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200 h-32 text-base outline-none text-gray-700 py-1 px-3 resize-none leading-6 transition-colors duration-200 ease-in-out">{{ $post->caption }}</textarea>
                </div>
              </div>
              <div class="p-2 w-full">
                <div class="relative">
                  <label for="post_photo" class="leading-7 text-sm text-gray-600">写真</label>
                  <p>※変更の場合のみ選択してください</p>
                  <input id="post_photo" type="file" name="post_photo">
                </div>
              </div>
              <div class="p-2 w-full">
                <div class="relative">
                  <p>新たに選択した写真：</p>
                  <img id="img1" class="w-3/5" />
                </div>
              </div>
              <div class="p-2 w-full">
                <div class="relative">
                  <p>元の写真：</p>
                  <img src="{{ asset('storage/image/posts/' . $post->post_photo) }}" class="w-3/5"/>
                </div>
              </div>
              <div class="p-2 w-full">
                <div class="relative">
                  <label for="location" class="leading-7 text-sm text-gray-600">撮影場所</label>
                  <input type="text" id="location" name="location" value="{{ $post->location }}" class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
                </div>
              </div>
              {{-- <div class="p-2 w-full">
                <div class="relative">
                  <label for="fish_name" class="leading-7 text-sm text-gray-600">魚名</label>
                  <input type="text" id="fish_name" name="fish_name" value="{{ $post->fish_name }}" class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
                </div>
              </div>
              <div class="p-2 w-full">
                <div class="relative">
                  <label for="fish_count" class="leading-7 text-sm text-gray-600">釣れた数</label>
                  <input type="number" id="fish_count" name="fish_count" value="{{ $post->fish_count }}" class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
                </div>
              </div> --}}
              <div class="p-2 w-full flex justify-around">
                <button type="button" onclick="history.back()" class="flex mx-auto text-white bg-gray-500 border-0 py-2 px-8 focus:outline-none hover:bg-gray-600 rounded text-lg">戻る</button>
                <button type="submit" class="flex mx-auto text-white bg-indigo-500 border-0 py-2 px-8 focus:outline-none hover:bg-indigo-600 rounded text-lg">編集する</button>
              </div>
            </div>
          </div>
        </div>
      </section>
      </form>

</x-app-layout>
