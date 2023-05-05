<?php

use Illuminate\Database\Seeder;

use App\FAQ;

class FAQsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faq = new FAQ([
        	'question' => 'Bagaimana cara saya mendapatkan Lampu Platinum?',
        	'answer' => 'Anda dapat membeli produk kami di toko-toko lampu atau listrik di area Jawa Tengah atau melalui Website kami.',
        ]);
        $faq->save();

        $faq = new FAQ([
        	'question' => 'Bagaimana prosedur pemesanan lampu di Website Platinum?',
        	'answer' => 'Ini adalah langkah-langkah dari perjalanan belanja Anda bersama kami : 
            1. Pilih produk Anda, tambahkan ke keranjang   ->  2. Periksa detail pesanan  ->  3. Konfirmasikan keranjang belanja Anda  ->  4. Memberikan informasi pengiriman & penagihan  ->  5. Pilih opsi pembayaran dan selesaikan pembayaran  ->  6. Anda akan melihat status transaksi pembayaran di layar Anda  ->  7. Untuk transaksi yang berhasil, kami akan segera mengirimkan konfirmasi pesanan melalui email kepada Anda.',
        ]);
        $faq->save();

        $faq = new FAQ([
            'question' => 'Bisakah Saya Memesan dalam Jumlah yang banyak?',
            'answer' => 'Untuk Pembelian dalam Jumlah Banyak anda dapat menghubungi Langsung Layanan Pelanggan Kami melalui whatsapp +62823 3320 1320.',
        ]);
        $faq->save();

        $faq = new FAQ([
            'question' => 'Dapatkah saya mengembalikan barang?',
            'answer' => 'Anda dapat mengembalikan barang apabila barang terbukti cacat produksi dan masih dalam batas garansi. Hubungi Layanan Pelanggan Kami untuk  tata cara pengembalian dan keluhan anda, Barang yang anda kembalikan akan kami tukar dengan yang baru.',
        ]);
        $faq->save();

        $faq = new FAQ([
            'question' => 'Berapa Lama Saya Menerima Pengembalian?',
            'answer' => 'Pengembalian akan dilakukan setelah barang diterima dan melalui pengecekan, bisa memakan waktu hingga 15 hari kerja.',
        ]);
        $faq->save();

        $faq = new FAQ([
            'question' => 'Berapa Kira-kira untuk biaya pengantaran?',
            'answer' => 'Untuk biaya pengiriman dapat anda lihat di (Link Terms & Condition).',
        ]);
        $faq->save();

        $faq = new FAQ([
            'question' => 'Kapan Pesanan Saya Akan tiba?',
            'answer' => 'Pengiriman berlangsung dalam waktu 1 hari sejak tanggal pemesanan. Waktu pengiriman dapat bervariasi sesuai dengan tujuan Anda. Selama musim ramai, kami meminta pengertian Anda karena waktu pengiriman mungkin lebih lama karena lonjakan volume pesanan.',
        ]);
        $faq->save();

        $faq = new FAQ([
            'question' => 'Bagaimana Cara Membatalkan Pesanan?',
            'answer' => 'Pesanan anda di Website kami akan otomatis dibatalkan, apabila anda belum melakukan pembayaran melalui website kami. Perhatian! Pesanan yang sudah dibayar tidak dapat dibatalkan.',
        ]);
        $faq->save();
    }
}
