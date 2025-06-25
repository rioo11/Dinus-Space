<div>

  <!-- Hero Section -->
<section class="flex flex-col md:flex-row items-center justify-between px-8 md:px-20 py-16 h-screen">
  <div class="max-w-lg mb-10 md:mb-0">
    <h1 class="text-4xl font-bold mb-4">SELAMAT DATANG DI DINUS SPACE</h1>
    <p class="text-gray-600 mb-6">Aplikasi untuk mempermudah pemesanan dan manajemen ruang kelas di Universitas Dian Nuswantoro. Kelola jadwal dan hindari konflik dengan lebih efisien!</p>
    <button class="bg-black text-white px-6 py-2 rounded">PESAN RUANGAN</button>
  </div>
  <img src="{{ asset('img/mahasiswa.png') }}" alt="Mahasiswa" class="w-full md:w-[800px]">
</section>


<!-- Prodi Section -->
<section class=" py-16 px-8 md:px-20 text-center">
  <h2 class="text-3xl font-semibold mb-10">PRODI <br> UNIVERSITAS DIAN NUSWANTORO</h2>
  <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-2 gap-8">
    <!-- Card 1 -->
    <div class="bg-white shadow-md p-6 rounded-lg">
      <img src="{{ asset('img/ti.png') }}" alt="TI" class="w-20 mx-auto mb-4">
      <h3 class="font-bold text-lg mb-2">Teknik Informatika</h3>
      <p class="text-sm text-gray-600 mb-4">Program ini fokus pada pengembangan perangkat lunak, jaringan komputer, dan sistem informasi untuk berbagai industri.</p>
    </div>
    <!-- Card 2 -->
    <div class="bg-white shadow-md p-6 rounded-lg">
      <img src="{{ asset('img/manajemen.png') }}" alt="Manajemen" class="w-20 mx-auto mb-4">
      <h3 class="font-bold text-lg mb-2">Manajemen</h3>
      <p class="text-sm text-gray-600 mb-4">Mengajarkan keterampilan dalam pengelolaan bisnis, keuangan, pemasaran, dan sumber daya manusia di berbagai organisasi.</p>
    </div>
    <!-- Card 3 -->
    <div class="bg-white shadow-md p-6 rounded-lg">
      <img src="{{ asset('img/si.png') }}" alt="SI" class="w-20 mx-auto mb-4">
      <h3 class="font-bold text-lg mb-2">Sistem Informatika</h3>
      <p class="text-sm text-gray-600 mb-4">Menggabungkan teknologi informasi dengan ilmu bisnis untuk merancang sistem yang mendukung keputusan berbasis data.</p>
    </div>
    <!-- Card 4 -->
    <div class="bg-white shadow-md p-6 rounded-lg">
      <img src="{{ asset('img/dkv.png') }}" alt="DKV" class="w-20 mx-auto mb-4">
      <h3 class="font-bold text-lg mb-2">Desain Komunikasi Visual</h3>
      <p class="text-sm text-gray-600 mb-4">Mempelajari cara menyampaikan pesan melalui desain grafis dan multimedia menggunakan berbagai perangkat desain digital.</p>
    </div>
  </div>
</section>




  <!-- Tentang -->
  <section class="flex flex-col-reverse md:flex-row items-center justify-between px-8 md:px-20 py-16 bg-indigo-50">
    <div class="max-w-xl mt-10 md:mt-0">
      <h2 class="text-2xl font-bold mb-4">DINUS SPACE adalah tempat pembookingan di Universitas Dian Nuswantoro</h2>
      <p class="text-gray-700 mb-6">
        Dinus Space adalah aplikasi yang memfasilitasi pemesanan dan manajemen ruang kelas, membantu menghindari konflik jadwal serta meningkatkan efisiensi operasional di Universitas Dian Nuswantoro Kediri.
      </p>
      <a href="#" class="bg-indigo-600 text-white px-5 py-2 rounded">Kontak Kami</a>
    </div>
    <img src="{{ asset('img/bookingss.png') }}" alt="Booking" class="w-full md:w-[400px]">
  </section>

  <!-- Kontak -->
  <section class="py-16 px-8 md:px-20 text-center">
    <h2 class="text-2xl font-bold mb-10">KONTAK KAMI</h2>
    <div class="flex flex-wrap justify-center gap-10">
      <div>
        <img src="img/phone.png" alt="Telpon" class="w-12 mx-auto mb-2">
        <p>Telepon Kami</p>
      </div>
      <div>
        <img src="img/wa.png" alt="WA" class="w-12 mx-auto mb-2">
        <p>Whatsapp</p>
      </div>
      <div>
        <img src="img/ig.png" alt="IG" class="w-12 mx-auto mb-2">
        <p>Instagram</p>
      </div>
      <div>
        <img src="img/email.png" alt="Email" class="w-12 mx-auto mb-2">
        <p>Email</p>
      </div>
    </div>
  </section>

  <!-- Footer -->
  <footer class="text-center text-sm py-6 border-t">
    <p class="mb-1">Jl. Imam Bonjol No.207, Semarang, Jawa Tengah 50131</p>
    <p class="text-gray-500">Copyright © 2024 SMK PEMUDA JUARA</p>
  </footer>

</div>
