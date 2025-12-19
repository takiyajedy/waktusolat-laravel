<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class WaktuSolatController extends Controller
{
    /**
     * Display the landing page
     */
    public function index()
    {
        return view('waktu-solat');
    }

    /**
     * Get prayer times for specific zone and date
     */
    public function getPrayerTimes(Request $request)
    {
        $zone = $request->input('zone', 'KDH01');
        $year = $request->input('year', date('Y'));
        $month = $request->input('month', date('m'));

        try {
            $response = Http::get("https://api.waktusolat.app/v2/solat/{$zone}", [
                'year' => $year,
                'month' => $month
            ]);

            if ($response->successful()) {
                return response()->json($response->json());
            }

            return response()->json(['error' => 'Failed to fetch data'], 500);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    /**
     * Get all zones
     */
    public function getZones()
    {
        $zones = [
            // Johor
            ['code' => 'JHR01', 'name' => 'Pulau Aur dan Pulau Pemanggil'],
            ['code' => 'JHR02', 'name' => 'Johor Bahru, Kota Tinggi, Mersing'],
            ['code' => 'JHR03', 'name' => 'Kluang, Pontian'],
            ['code' => 'JHR04', 'name' => 'Batu Pahat, Muar, Segamat, Gemas'],
            
            // Kedah
            ['code' => 'KDH01', 'name' => 'Kota Setar, Kubang Pasu, Pokok Sena'],
            ['code' => 'KDH02', 'name' => 'Kuala Muda, Yan, Pendang'],
            ['code' => 'KDH03', 'name' => 'Padang Terap, Sik'],
            ['code' => 'KDH04', 'name' => 'Baling'],
            ['code' => 'KDH05', 'name' => 'Bandar Baharu, Kulim'],
            ['code' => 'KDH06', 'name' => 'Langkawi'],
            ['code' => 'KDH07', 'name' => 'Puncak Gunung Jerai'],
            
            // Kelantan
            ['code' => 'KTN01', 'name' => 'Kota Bharu, Bachok, Pasir Puteh'],
            ['code' => 'KTN03', 'name' => 'Jeli, Gua Musang'],
            
            // Melaka
            ['code' => 'MLK01', 'name' => 'Seluruh Negeri Melaka'],
            
            // Negeri Sembilan
            ['code' => 'NGS01', 'name' => 'Tampin, Jempol'],
            ['code' => 'NGS02', 'name' => 'Port Dickson, Seremban, Kuala Pilah'],
            
            // Pahang
            ['code' => 'PHG01', 'name' => 'Pulau Tioman'],
            ['code' => 'PHG02', 'name' => 'Kuantan, Pekan, Rompin, Muadzam Shah'],
            ['code' => 'PHG03', 'name' => 'Jerantut, Temerloh, Maran, Bera'],
            ['code' => 'PHG04', 'name' => 'Bentong, Lipis, Raub'],
            ['code' => 'PHG05', 'name' => 'Genting Highlands, Cameron Highlands'],
            ['code' => 'PHG06', 'name' => 'Bukit Tinggi'],
            
            // Perlis
            ['code' => 'PLS01', 'name' => 'Seluruh Negeri Perlis'],
            
            // Penang
            ['code' => 'PNG01', 'name' => 'Seluruh Negeri Pulau Pinang'],
            
            // Perak
            ['code' => 'PRK01', 'name' => 'Tapah, Slim River, Tanjung Malim'],
            ['code' => 'PRK02', 'name' => 'Kuala Kangsar, Sg. Siput, Ipoh'],
            ['code' => 'PRK03', 'name' => 'Lenggong, Pengkalan Hulu, Grik'],
            ['code' => 'PRK04', 'name' => 'Temengor, Belum'],
            ['code' => 'PRK05', 'name' => 'Kg Gajah, Teluk Intan, Bagan Datuk'],
            ['code' => 'PRK06', 'name' => 'Lumut, Sitiawan, Pulau Pangkor'],
            ['code' => 'PRK07', 'name' => 'Selama, Taiping, Bagan Serai'],
            
            // Sabah
            ['code' => 'SBH01', 'name' => 'Sandakan, Bdr. Bkt. Garam, Semawang'],
            ['code' => 'SBH02', 'name' => 'Kota Kinabalu, Ranau, Kota Belud'],
            ['code' => 'SBH03', 'name' => 'Lahad Datu, Kunak, Semporna'],
            ['code' => 'SBH04', 'name' => 'Tawau'],
            ['code' => 'SBH05', 'name' => 'Kudat, Kota Marudu, Pitas'],
            ['code' => 'SBH06', 'name' => 'Gunung Kinabalu'],
            ['code' => 'SBH07', 'name' => 'Keningau, Tambunan, Nabawan'],
            ['code' => 'SBH08', 'name' => 'Beaufort, Kuala Penyu, Sipitang'],
            ['code' => 'SBH09', 'name' => 'Tenom, Pensiangan'],
            
            // Selangor
            ['code' => 'SGR01', 'name' => 'Gombak, Petaling, Sepang, Hulu Langat'],
            ['code' => 'SGR02', 'name' => 'Kuala Selangor, Sabak Bernam'],
            ['code' => 'SGR03', 'name' => 'Klang, Kuala Langat'],
            
            // Sarawak
            ['code' => 'SWK01', 'name' => 'Kuching, Samarahan, Simunjan, Serian'],
            ['code' => 'SWK02', 'name' => 'Betong, Saratok, Debak, Sri Aman'],
            ['code' => 'SWK03', 'name' => 'Sibu, Mukah, Dalat, Oya'],
            ['code' => 'SWK04', 'name' => 'Sarikei, Bintangor, Rajang, Julau'],
            ['code' => 'SWK05', 'name' => 'Bintulu, Tatau, Sebauh, Belaga'],
            ['code' => 'SWK06', 'name' => 'Miri, Niah, Bekenu, Sibuti'],
            ['code' => 'SWK07', 'name' => 'Limbang, Sundar, Terusan, Lawas'],
            ['code' => 'SWK08', 'name' => 'Kapit, Song, Pelagus'],
            ['code' => 'SWK09', 'name' => 'Bau, Lundu, Sematan'],
            
            // Terengganu
            ['code' => 'TRG01', 'name' => 'Kuala Terengganu, Marang'],
            ['code' => 'TRG02', 'name' => 'Besut, Setiu'],
            ['code' => 'TRG03', 'name' => 'Hulu Terengganu'],
            ['code' => 'TRG04', 'name' => 'Dungun, Kemaman'],
            
            // WP
            ['code' => 'WLY01', 'name' => 'Kuala Lumpur'],
            ['code' => 'WLY02', 'name' => 'Labuan'],
            ['code' => 'WLY03', 'name' => 'Putrajaya'],
        ];

        return response()->json($zones);
    }

    public function fromGps(Request $request)
{
    $lat = $request->lat;
    $long = $request->long;

    if (!$lat || !$long) {
        return response()->json(['error' => 'Lokasi tidak sah'], 400);
    }

    $response = Http::get(
        "https://api.waktusolat.app/v2/solat/gps/$lat/$long"
    );

    if ($response->failed()) {
        return response()->json(['error' => 'Gagal dapatkan waktu solat'], 500);
    }

    return $response->json();
}
}
