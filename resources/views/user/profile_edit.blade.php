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

      <form action="{{ route('users.update', ['user' => $user->id]) }}" enctype="multipart/form-data" method="post">
      @csrf
      @method('put')
      <section class="text-gray-600 body-font relative z-0">
        <div class="container px-5 py-24 mx-auto">
          <div class="flex flex-col text-center w-full mb-12">
            <h1 class="sm:text-3xl text-2xl font-medium title-font mb-4 text-gray-900">プロフィール編集</h1>
            <p class="lg:w-2/3 mx-auto leading-relaxed text-base">編集する内容を入力してください。</p>
          </div>
          <div class="lg:w-1/2 md:w-2/3 mx-auto">
            <div class="flex flex-wrap -m-2">
              <div class="p-2 w-full">
                <div class="relative">
                  <label for="name" class="leading-7 text-sm text-gray-600">名前</label>
                  <input type="text" id="name" name="name" class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out" value="{{ $user->name }}">
                </div>
              </div>
              <div class="p-2 w-full">
                <div class="relative">
                  <label for="profile_comment" class="leading-7 text-sm text-gray-600">自己紹介</label>
                  <textarea id="profile_comment" name="profile_comment" class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200 h-32 text-base outline-none text-gray-700 py-1 px-3 resize-none leading-6 transition-colors duration-200 ease-in-out">{{ $user->profile_comment }}</textarea>
                </div>
              </div>
              <div class="p-2 w-full">
                <div class="relative">
                  <p>※変更する場合のみ選択してください</p>
                  <label for="profile_photo" class="leading-7 text-sm text-gray-600">写真：</label>
                  <input id="profile_photo" type="file" name="profile_photo">
                </div>
              </div>
              <div class="p-2 w-full">
                <div class="relative">
                  <p>新たに選択した写真：</p>
                  {{-- <input type="file" id="myfile"><br> --}}
                  <img id="img" class="w-3/5"/>
                </div>
              </div>
              <div class="p-2 w-full">
                <div class="relative">
                  <p>元の写真：</p>
                  <img src="{{ asset('storage/image/users/' . $user->profile_photo) }}" class="w-3/5"/>
                </div>
              </div>
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
