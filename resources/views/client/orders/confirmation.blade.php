<x-app-layout>
    <x-slot name="header">
        <h2 class="font-bold text-2xl text-gray-800">
            {{ __('🎉 Order Confirmation') }}
        </h2>
    </x-slot>

    <div class="py-12 bg-gradient-to-br from-green-50 to-white min-h-[80vh]">


               <div class="flex flex-col items-center justify-center min-h-screen bg-gray-50 p-4">
  <div class="bg-white shadow-lg rounded-lg p-6 w-full max-w-2xl">
    <div class="flex flex-col items-center">
      <div class="bg-green-100 rounded-full p-4 mb-4">
        ✅
      </div>
      <h2 class="text-2xl font-bold text-green-700">Thank you for your order!</h2>
      <p class="text-gray-600">Your order #1 has been placed successfully.</p>
      <div class="mt-6 border-t pt-4">
      <h3 class="text-lg font-semibold mb-2">🧾 Order Summary</h3>
      <p><strong>Name:</strong> Ahmed Mahmoud</p>
      <p><strong>Phone:</strong> 01029804915</p>
      <p><strong>Address:</strong> Elmanshia st</p>
      <p class="text-xl text-green-600 mt-2"><strong>Total Amount:</strong> $406.92</p>
      <br>
      <div class="mt-8 text-center">
                    <a href="{{ route('home') }}" class="inline-block bg-green-600 hover:bg-green-700 text-gray-100 font-semibold py-2 px-6 rounded-full shadow-md transition duration-300">
                        🛍 Continue Shopping
                    </a>
         </div>
    </div>
    </div>


  </div>
</div>



            </div>
        </div>
    </div>

    <style>
        @keyframes fade-in-down {
            0% { opacity: 0; transform: translateY(-10px); }
            100% { opacity: 1; transform: translateY(0); }
        }
        .animate-fade-in-down {
            animation: fade-in-down 0.5s ease-out;
        }
    </style>
</x-app-layout>
