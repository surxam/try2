
@extends('layouts.boutique')
 

@section('content')
<script src="https://cdn.jsdelivr.net/npm/flowbite@4.0.1/dist/flowbite.min.js"></script>

  <div id="default-carousel" class="relative w-full" data-carousel="slide">
    <!-- Carousel wrapper -->
    <div class="relative h-56 overflow-hidden rounded-base md:h-96">

        @forelse ($newProducts as $newProduct)
                <div class="absolute inset-0 duration-700 ease-in-out bg-gray-800" data-carousel-item>
                    <img src="{{ $newProduct->image_url }}"
                        class="absolute block w-[50%] rounded-md bg-gray-200 object-contain group-hover:opacity-75 lg:aspect-auto lg:h-80 left-1/2 -translate-x-1/2" 
                        alt="{{ $newProduct->name }}">
                    <div class="absolute top-1/2 left-[80%] text-white -translate-x-1/2 -translate-y-1/2 w-1/3 text-center">

                        <h3 class="text-2xl font-semibold sm:text-3xl amber-500:text-black mb-2">
                            <a href="{{ route('products.show', $newProduct->slug) }}">
                                {{ $newProduct->name }}
                            </a>

                        </h3> 

                        <p class="text-lg"> 
                            {{ $newProduct->short_description }} 
                        </p> 

                        <div class="mt-4">
                            <a href="{{ route('products.show', $newProduct->slug) }}"
                                class="inline-block px-5 py-3 text-sm font-medium text-white bg-gray-600 rounded-md hover:bg-gray-700">
                                    Voir le produit
                            </a> 
                        </div> 

                        <p class="mt-4 text-sm italic">

                            Maintenant Disponible En Ligne !
                        </p>
                    </div>

                </div>
            @empty
                Bientôt les nouveautés !
            @endforelse
    </div>
    <!-- Slider indicators -->
    <div class="absolute z-30 flex -translate-x-1/2 bottom-5 left-1/2 space-x-3 rtl:space-x-reverse">
        <button type="button" class="w-3 h-3 rounded-base" aria-current="true" aria-label="Slide 1" data-carousel-slide-to="0"></button>
        <button type="button" class="w-3 h-3 rounded-base" aria-current="false" aria-label="Slide 2" data-carousel-slide-to="1"></button>
        <button type="button" class="w-3 h-3 rounded-base" aria-current="false" aria-label="Slide 3" data-carousel-slide-to="2"></button>
        <button type="button" class="w-3 h-3 rounded-base" aria-current="false" aria-label="Slide 4" data-carousel-slide-to="3"></button>
        <button type="button" class="w-3 h-3 rounded-base" aria-current="false" aria-label="Slide 5" data-carousel-slide-to="4"></button>
    </div>
    <!-- Slider controls -->
    <button type="button" class="absolute top-0 start-0 z-30 flex items-center justify-center h-full px-4 cursor-pointer group focus:outline-none" data-carousel-prev>
        <span class="inline-flex items-center justify-center w-10 h-10 rounded-base bg-white/30 dark:bg-gray-800/30 group-hover:bg-white/50 dark:group-hover:bg-gray-800/60 group-focus:ring-4 group-focus:ring-white dark:group-focus:ring-gray-800/70 group-focus:outline-none">
            <svg class="w-5 h-5 text-white rtl:rotate-180" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24"><path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m15 19-7-7 7-7"/></svg>
            <span class="sr-only">Previous</span>
        </span>
    </button>
    <button type="button" class="absolute top-0 end-0 z-30 flex items-center justify-center h-full px-4 cursor-pointer group focus:outline-none" data-carousel-next>
        <span class="inline-flex items-center justify-center w-10 h-10 rounded-base bg-white/30 dark:bg-gray-800/30 group-hover:bg-white/50 dark:group-hover:bg-gray-800/60 group-focus:ring-4 group-focus:ring-white dark:group-focus:ring-gray-800/70 group-focus:outline-none">
            <svg class="w-5 h-5 text-white rtl:rotate-180" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24"><path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m9 5 7 7-7 7"/></svg>
            <span class="sr-only">Next</span>
        </span>
    </button>
</div>



  

   <div class="bg-white">
  <div class="mx-auto max-w-2xl px-4 py-16 sm:px-6 sm:py-24 lg:max-w-7xl lg:px-8">
    <h2 class="text-2xl font-bold tracking-tight text-gray-900">Nouveau</h2>

        <div class="mt-6 grid grid-cols-1 gap-x-6 gap-y-10 sm:grid-cols-2 lg:grid-cols-4 xl:gap-x-8">
        
            @foreach ($newProducts as $newProduct )
                <x-card-product :product="$newProduct"/>
            @endforeach
            

        
        </div>
      </div>
    </div>


      <div class="bg-white">
      <div class="mx-auto max-w-2xl px-4 py-16 sm:px-6 sm:py-24 lg:max-w-7xl lg:px-8">
        <h2 class="text-2xl font-bold tracking-tight text-gray-900">Featured product</h2>

        <div class="mt-6 grid grid-cols-1 gap-x-6 gap-y-10 sm:grid-cols-2 lg:grid-cols-4 xl:gap-x-8">
        
            @foreach ($featuredProducts as $featuredProduct )
                <x-card-product :product="$featuredProduct"/>
            @endforeach
            

        
        </div>
      </div>
    </div>




      <div class="bg-white">
      <div class="mx-auto max-w-2xl px-4 py-16 sm:px-6 sm:py-24 lg:max-w-7xl lg:px-8">
        <h2 class="text-2xl font-bold tracking-tight text-gray-900">Sale product</h2>

        <div class="mt-6 grid grid-cols-1 gap-x-6 gap-y-10 sm:grid-cols-2 lg:grid-cols-4 xl:gap-x-8">
        
            @foreach ($saleProducts as $saleProduct )
                <x-card-product :product="$saleProduct"/>
            @endforeach
            

        
        </div>
      </div>
    </div>


@endsection
   