<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class OrkTeamSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $items = [
            ['id' => 1, 'name' => 'Natalia Tucholska', 'rehabitation_center' => 1, 'specialization' => 1, 'is_accepted' => 1, 'date_of_acceptance' => '2021-03-03', 'status' => 1],
            ['id' => 2, 'name' => 'Marcin Adamczak', 'rehabitation_center' => 1, 'specialization' => 1, 'is_accepted' => 1, 'date_of_acceptance' => '2021-03-03', 'status' => 1],
            ['id' => 3, 'name' => 'Beata Piasecka', 'rehabitation_center' => 1, 'specialization' => 1, 'is_accepted' => 1, 'date_of_acceptance' => '2021-03-03', 'status' => 1],
            ['id' => 4, 'name' => 'Edyta Rączkowiak', 'rehabitation_center' => 1, 'specialization' => 1, 'is_accepted' => 1, 'date_of_acceptance' => '2021-03-03', 'status' => 1],
            ['id' => 5, 'name' => 'Anna Brewińska', 'rehabitation_center' => 1, 'specialization' => 1, 'is_accepted' => 1, 'date_of_acceptance' => '2021-03-03', 'status' => 1],
            ['id' => 6, 'name' => 'Dagmara Czaplewska', 'rehabitation_center' => 1, 'specialization' => 1, 'is_accepted' => 1, 'date_of_acceptance' => '2021-03-03', 'status' => 1],
            ['id' => 7, 'name' => 'Jacek Puchalski', 'rehabitation_center' => 1, 'specialization' => 1, 'is_accepted' => 1, 'date_of_acceptance' => '2021-03-03', 'status' => 1],
            ['id' => 8, 'name' => 'Anna Chrzempa', 'rehabitation_center' => 1, 'specialization' => 12, 'is_accepted' => 1, 'date_of_acceptance' => '2021-03-03', 'status' => 1],
            ['id' => 9, 'name' => 'Marcin Nowak', 'rehabitation_center' => 1, 'specialization' => 3, 'is_accepted' => 1, 'date_of_acceptance' => '2021-03-03', 'status' => 1],
            ['id' => 10, 'name' => 'Aneta Narowska', 'rehabitation_center' => 1, 'specialization' => 3, 'is_accepted' => 1, 'date_of_acceptance' => '2021-03-03', 'status' => 1],
            ['id' => 11, 'name' => 'Małgorzata Gogolewska', 'rehabitation_center' => 1, 'specialization' => 3, 'is_accepted' => 1, 'date_of_acceptance' => '2021-03-03', 'status' => 1],
            ['id' => 12, 'name' => 'Paweł Warsiński', 'rehabitation_center' => 1, 'specialization' => 3, 'is_accepted' => 1, 'date_of_acceptance' => '2021-03-03', 'status' => 1],
            ['id' => 13, 'name' => 'Ewa Maliszewska', 'rehabitation_center' => 1, 'specialization' => 3, 'is_accepted' => 1, 'date_of_acceptance' => '2021-03-03', 'status' => 1],
            ['id' => 14, 'name' => 'Katarzyna Fleta', 'rehabitation_center' => 1, 'specialization' => 3, 'is_accepted' => 1, 'date_of_acceptance' => '2021-03-03', 'status' => 1],
            ['id' => 15, 'name' => 'Karolina Kulczak Drozdowska', 'rehabitation_center' => 1, 'specialization' => 3, 'is_accepted' => 1, 'date_of_acceptance' => '2021-03-03', 'status' => 1],
            ['id' => 16, 'name' => 'Ewelina Kasprzak', 'rehabitation_center' => 1, 'specialization' => 3, 'is_accepted' => 1, 'date_of_acceptance' => '2021-03-03', 'status' => 1],
            ['id' => 17, 'name' => 'Małgorzata Skrzyszowska', 'rehabitation_center' => 1, 'specialization' => 4, 'is_accepted' => 1, 'date_of_acceptance' => '2021-03-03', 'status' => 1],
            ['id' => 18, 'name' => 'Daniel Plewa', 'rehabitation_center' => 1, 'specialization' => 4, 'is_accepted' => 1, 'date_of_acceptance' => '2021-03-03', 'status' => 1],
            ['id' => 19, 'name' => 'Małgorzata Stachowiak-Grochola', 'rehabitation_center' => 1, 'specialization' => 4, 'is_accepted' => 1, 'date_of_acceptance' => '2021-03-03', 'status' => 1],
            ['id' => 20, 'name' => 'Ewa Baranowska', 'rehabitation_center' => 1, 'specialization' => 4, 'is_accepted' => 1, 'date_of_acceptance' => '2021-03-03', 'status' => 1],
            ['id' => 21, 'name' => 'Katazrzyna Fleta', 'rehabitation_center' => 1, 'specialization' => 4, 'is_accepted' => 1, 'date_of_acceptance' => '2021-03-03', 'status' => 1],
            ['id' => 22, 'name' => 'Karolina Kulczak Drozdowska', 'rehabitation_center' => 1, 'specialization' => 4, 'is_accepted' => 1, 'date_of_acceptance' => '2021-03-03', 'status' => 1],
            ['id' => 23, 'name' => 'Monika Werbińska', 'rehabitation_center' => 1, 'specialization' => 4, 'is_accepted' => 1, 'date_of_acceptance' => '2021-03-03', 'status' => 1],
            ['id' => 24, 'name' => 'Michalina Kozanecka', 'rehabitation_center' => 1, 'specialization' => 2, 'is_accepted' => 1, 'date_of_acceptance' => '2021-03-03', 'status' => 1],
            ['id' => 25, 'name' => 'Jolanta Tomaszewska', 'rehabitation_center' => 1, 'specialization' => 2, 'is_accepted' => 1, 'date_of_acceptance' => '2021-03-03', 'status' => 1],
            ['id' => 26, 'name' => 'Mirela Dolomisiewicz', 'rehabitation_center' => 1, 'specialization' => 2, 'is_accepted' => 1, 'date_of_acceptance' => '2021-03-03', 'status' => 1],
            ['id' => 27, 'name' => 'Anna Rossowska-Grudzińska', 'rehabitation_center' => 1, 'specialization' => 2, 'is_accepted' => 1, 'date_of_acceptance' => '2021-03-03', 'status' => 1],
            ['id' => 28, 'name' => 'Katarzyna Bieńczak', 'rehabitation_center' => 1, 'specialization' => 2, 'is_accepted' => 1, 'date_of_acceptance' => '2021-03-03', 'status' => 1],
            ['id' => 29, 'name' => 'Magdalena Korczak Zachwyc', 'rehabitation_center' => 1, 'specialization' => 2, 'is_accepted' => 1, 'date_of_acceptance' => '2021-03-03', 'status' => 1],
            ['id' => 30, 'name' => 'Magdalena Pawłowska', 'rehabitation_center' => 1, 'specialization' => 13, 'is_accepted' => 1, 'date_of_acceptance' => '2021-03-03', 'status' => 1],
            ['id' => 31, 'name' => 'Lidia Ławniczak', 'rehabitation_center' => 1, 'specialization' => 13, 'is_accepted' => 1, 'date_of_acceptance' => '2021-03-03', 'status' => 1],
            ['id' => 32, 'name' => 'Agata Epsztajn Brodziak', 'rehabitation_center' => 1, 'specialization' => 6, 'is_accepted' => 1, 'date_of_acceptance' => '2021-03-03', 'status' => 1],
            ['id' => 33, 'name' => 'Ewa Woźnicka', 'rehabitation_center' => 1, 'specialization' => 6, 'is_accepted' => 1, 'date_of_acceptance' => '2021-03-03', 'status' => 1],
            ['id' => 34, 'name' => 'Damian Lorc', 'rehabitation_center' => 1, 'specialization' => 14, 'is_accepted' => 1, 'date_of_acceptance' => '2021-03-03', 'status' => 1],
            ['id' => 35, 'name' => 'Daria Kasperek/ Szulc', 'rehabitation_center' => 1, 'specialization' => 14, 'is_accepted' => 1, 'date_of_acceptance' => '2021-03-03', 'status' => 1],
            ['id' => 36, 'name' => 'Hanna Ciesielska', 'rehabitation_center' => 1, 'specialization' => 14, 'is_accepted' => 1, 'date_of_acceptance' => '2021-03-03', 'status' => 1],
            ['id' => 37, 'name' => 'Ewa Wieczorkiewicz', 'rehabitation_center' => 1, 'specialization' => 14, 'is_accepted' => 1, 'date_of_acceptance' => '2021-03-03', 'status' => 1],
            ['id' => 38, 'name' => 'Julia Ridigier', 'rehabitation_center' => 1, 'specialization' => 14, 'is_accepted' => 1, 'date_of_acceptance' => '2021-03-03', 'status' => 1],
            ['id' => 39, 'name' => 'Magdalena Bilska', 'rehabitation_center' => 1, 'specialization' => 14, 'is_accepted' => 1, 'date_of_acceptance' => '2021-03-03', 'status' => 1],
            ['id' => 40, 'name' => 'Magdalena Czajkowska', 'rehabitation_center' => 1, 'specialization' => 14, 'is_accepted' => 1, 'date_of_acceptance' => '2021-03-03', 'status' => 1],
            ['id' => 41, 'name' => 'Ewelina Kędziora', 'rehabitation_center' => 1, 'specialization' => 14, 'is_accepted' => 1, 'date_of_acceptance' => '2021-03-03', 'status' => 1],
            ['id' => 42, 'name' => 'Natalia Czajkowska', 'rehabitation_center' => 1, 'specialization' => 14, 'is_accepted' => 1, 'date_of_acceptance' => '2021-03-03', 'status' => 1],
            ['id' => 43, 'name' => 'Marika Budnik', 'rehabitation_center' => 1, 'specialization' => 14, 'is_accepted' => 1, 'date_of_acceptance' => '2021-03-03', 'status' => 1],
            ['id' => 44, 'name' => 'Marek Michalak', 'rehabitation_center' => 1, 'specialization' => 8, 'is_accepted' => 1, 'date_of_acceptance' => '2021-03-03', 'status' => 1],
            ['id' => 45, 'name' => 'Artur Czajka', 'rehabitation_center' => 1, 'specialization' => 8, 'is_accepted' => 1, 'date_of_acceptance' => '2021-03-03', 'status' => 1],
            ['id' => 46, 'name' => 'Barbara Sadowska Pisarek', 'rehabitation_center' => 1, 'specialization' => 8, 'is_accepted' => 1, 'date_of_acceptance' => '2021-03-03', 'status' => 1],
            ['id' => 47, 'name' => 'Anna Stachowiak – Ignac', 'rehabitation_center' => 1, 'specialization' => 15, 'is_accepted' => 1, 'date_of_acceptance' => '2021-03-03', 'status' => 1],
            ['id' => 48, 'name' => 'Maja Szuman', 'rehabitation_center' => 1, 'specialization' => 10, 'is_accepted' => 1, 'date_of_acceptance' => '2021-03-03', 'status' => 1],
            ['id' => 49, 'name' => 'Paulina Zurek', 'rehabitation_center' => 1, 'specialization' => 16, 'is_accepted' => 1, 'date_of_acceptance' => '2021-03-03', 'status' => 1],
            ['id' => 50, 'name' => 'Karina Krzemińska', 'rehabitation_center' => 2, 'specialization' => 1, 'is_accepted' => 1, 'date_of_acceptance' => '2021-03-03', 'status' => 1],
            ['id' => 51, 'name' => 'Kinga Modlińska', 'rehabitation_center' => 2, 'specialization' => 1, 'is_accepted' => 1, 'date_of_acceptance' => '2021-03-03', 'status' => 1],
            ['id' => 52, 'name' => 'Bartosz Kajsutra', 'rehabitation_center' => 2, 'specialization' => 1, 'is_accepted' => 1, 'date_of_acceptance' => '2021-03-03', 'status' => 1],
            ['id' => 53, 'name' => 'Anna Andrzejewska', 'rehabitation_center' => 2, 'specialization' => 1, 'is_accepted' => 1, 'date_of_acceptance' => '2021-03-03', 'status' => 1],
            ['id' => 54, 'name' => 'Izabela Jaworska', 'rehabitation_center' => 2, 'specialization' => 1, 'is_accepted' => 1, 'date_of_acceptance' => '2021-03-03', 'status' => 1],
            ['id' => 55, 'name' => 'Danuta Heczko', 'rehabitation_center' => 2, 'specialization' => 17, 'is_accepted' => 1, 'date_of_acceptance' => '2021-03-03', 'status' => 1],
            ['id' => 56, 'name' => 'Mirella Szcześniak', 'rehabitation_center' => 2, 'specialization' => 3, 'is_accepted' => 1, 'date_of_acceptance' => '2021-03-03', 'status' => 1],
            ['id' => 57, 'name' => 'Katarzyna Hankus', 'rehabitation_center' => 2, 'specialization' => 3, 'is_accepted' => 1, 'date_of_acceptance' => '2021-03-03', 'status' => 1],
            ['id' => 58, 'name' => 'Katarzyna Drózd', 'rehabitation_center' => 2, 'specialization' => 3, 'is_accepted' => 1, 'date_of_acceptance' => '2021-03-03', 'status' => 1],
            ['id' => 59, 'name' => 'Lucyna Pietrzyk-Nyc', 'rehabitation_center' => 2, 'specialization' => 3, 'is_accepted' => 1, 'date_of_acceptance' => '2021-03-03', 'status' => 1],
            ['id' => 60, 'name' => 'Ewa Kucypera', 'rehabitation_center' => 2, 'specialization' => 3, 'is_accepted' => 1, 'date_of_acceptance' => '2021-03-03', 'status' => 1],
            ['id' => 61, 'name' => 'Jolanta Tereszkiewicz', 'rehabitation_center' => 2, 'specialization' => 4, 'is_accepted' => 1, 'date_of_acceptance' => '2021-03-03', 'status' => 1],
            ['id' => 62, 'name' => 'Tomasz Bąk', 'rehabitation_center' => 2, 'specialization' => 4, 'is_accepted' => 1, 'date_of_acceptance' => '2021-03-03', 'status' => 1],
            ['id' => 63, 'name' => 'Wioletta Migacz-Lorek', 'rehabitation_center' => 2, 'specialization' => 2, 'is_accepted' => 1, 'date_of_acceptance' => '2021-03-03', 'status' => 1],
            ['id' => 64, 'name' => 'Katarzyna Zych', 'rehabitation_center' => 2, 'specialization' => 2, 'is_accepted' => 1, 'date_of_acceptance' => '2021-03-03', 'status' => 1],
            ['id' => 65, 'name' => 'Wiesław Dronka', 'rehabitation_center' => 2, 'specialization' => 13, 'is_accepted' => 1, 'date_of_acceptance' => '2021-03-03', 'status' => 1],
            ['id' => 66, 'name' => 'Jolanta Lichwa', 'rehabitation_center' => 2, 'specialization' => 6, 'is_accepted' => 1, 'date_of_acceptance' => '2021-03-03', 'status' => 1],
            ['id' => 67, 'name' => 'Anna Zietek Ostrowska', 'rehabitation_center' => 2, 'specialization' => 6, 'is_accepted' => 1, 'date_of_acceptance' => '2021-03-03', 'status' => 1],
            ['id' => 68, 'name' => 'Agnieszka Kajsutra', 'rehabitation_center' => 2, 'specialization' => 14, 'is_accepted' => 1, 'date_of_acceptance' => '2021-03-03', 'status' => 1],
            ['id' => 69, 'name' => 'Piotr Gomola', 'rehabitation_center' => 2, 'specialization' => 14, 'is_accepted' => 1, 'date_of_acceptance' => '2021-03-03', 'status' => 1],
            ['id' => 70, 'name' => 'Anna Andrzejewska', 'rehabitation_center' => 2, 'specialization' => 14, 'is_accepted' => 1, 'date_of_acceptance' => '2021-03-03', 'status' => 1],
            ['id' => 71, 'name' => 'Izabela Jaworska', 'rehabitation_center' => 2, 'specialization' => 14, 'is_accepted' => 1, 'date_of_acceptance' => '2021-03-03', 'status' => 1],
            ['id' => 72, 'name' => 'Kinga Modlinska', 'rehabitation_center' => 2, 'specialization' => 14, 'is_accepted' => 1, 'date_of_acceptance' => '2021-03-03', 'status' => 1],
            ['id' => 73, 'name' => 'Bartosz Kajsutra', 'rehabitation_center' => 2, 'specialization' => 14, 'is_accepted' => 1, 'date_of_acceptance' => '2021-03-03', 'status' => 1],
            ['id' => 74, 'name' => 'Tomasz Lasoń', 'rehabitation_center' => 2, 'specialization' => 14, 'is_accepted' => 1, 'date_of_acceptance' => '2021-03-03', 'status' => 1],
            ['id' => 75, 'name' => 'Jolanta Pierchała', 'rehabitation_center' => 2, 'specialization' => 8, 'is_accepted' => 1, 'date_of_acceptance' => '2021-03-03', 'status' => 1],
            ['id' => 76, 'name' => 'Justyna Jarmoszko', 'rehabitation_center' => 2, 'specialization' => 8, 'is_accepted' => 1, 'date_of_acceptance' => '2021-03-03', 'status' => 1],
            ['id' => 77, 'name' => 'Mieczysława Jędrusińska', 'rehabitation_center' => 2, 'specialization' => 15, 'is_accepted' => 1, 'date_of_acceptance' => '2021-03-03', 'status' => 1],
            ['id' => 78, 'name' => 'Anna Brończyk-Puzoń', 'rehabitation_center' => 2, 'specialization' => 9, 'is_accepted' => 1, 'date_of_acceptance' => '2021-03-03', 'status' => 1],
            ['id' => 79, 'name' => 'Magdalena Myrta', 'rehabitation_center' => 2, 'specialization' => 10, 'is_accepted' => 1, 'date_of_acceptance' => '2021-03-03', 'status' => 1],
            ['id' => 80, 'name' => 'Beata Prusak', 'rehabitation_center' => 2, 'specialization' => 16, 'is_accepted' => 1, 'date_of_acceptance' => '2021-03-03', 'status' => 1],
            ['id' => 81, 'name' => 'Wioletta Bojanowska', 'rehabitation_center' => 3, 'specialization' => 1, 'is_accepted' => 1, 'date_of_acceptance' => '2021-03-03', 'status' => 1],
            ['id' => 82, 'name' => 'Agnieszka Zalewska', 'rehabitation_center' => 3, 'specialization' => 1, 'is_accepted' => 1, 'date_of_acceptance' => '2021-03-03', 'status' => 1],
            ['id' => 83, 'name' => 'Danuta Rosińska', 'rehabitation_center' => 3, 'specialization' => 1, 'is_accepted' => 1, 'date_of_acceptance' => '2021-03-03', 'status' => 1],
            ['id' => 84, 'name' => 'Renata Jarzębska', 'rehabitation_center' => 3, 'specialization' => 1, 'is_accepted' => 1, 'date_of_acceptance' => '2021-03-03', 'status' => 1],
            ['id' => 85, 'name' => 'Sylwia Nowak', 'rehabitation_center' => 3, 'specialization' => 12, 'is_accepted' => 1, 'date_of_acceptance' => '2021-03-03', 'status' => 1],
            ['id' => 86, 'name' => 'Stanisław Podlaski', 'rehabitation_center' => 3, 'specialization' => 3, 'is_accepted' => 1, 'date_of_acceptance' => '2021-03-03', 'status' => 1],
            ['id' => 87, 'name' => 'Krzysztof Matosek', 'rehabitation_center' => 3, 'specialization' => 3, 'is_accepted' => 1, 'date_of_acceptance' => '2021-03-03', 'status' => 1],
            ['id' => 88, 'name' => 'Ilona Jarecka', 'rehabitation_center' => 3, 'specialization' => 3, 'is_accepted' => 1, 'date_of_acceptance' => '2021-03-03', 'status' => 1],
            ['id' => 89, 'name' => 'Beata Jagielska', 'rehabitation_center' => 3, 'specialization' => 3, 'is_accepted' => 1, 'date_of_acceptance' => '2021-03-03', 'status' => 1],
            ['id' => 90, 'name' => 'Przemysław Laskowski', 'rehabitation_center' => 3, 'specialization' => 3, 'is_accepted' => 1, 'date_of_acceptance' => '2021-03-03', 'status' => 1],
            ['id' => 91, 'name' => 'Przemysław Laskowski', 'rehabitation_center' => 3, 'specialization' => 4, 'is_accepted' => 1, 'date_of_acceptance' => '2021-03-03', 'status' => 1],
            ['id' => 92, 'name' => 'Magdalena Drozd', 'rehabitation_center' => 3, 'specialization' => 4, 'is_accepted' => 1, 'date_of_acceptance' => '2021-03-03', 'status' => 1],
            ['id' => 93, 'name' => 'Renata Macoch', 'rehabitation_center' => 3, 'specialization' => 2, 'is_accepted' => 1, 'date_of_acceptance' => '2021-03-03', 'status' => 1],
            ['id' => 94, 'name' => 'Grażyna Sobala', 'rehabitation_center' => 3, 'specialization' => 2, 'is_accepted' => 1, 'date_of_acceptance' => '2021-03-03', 'status' => 1],
            ['id' => 95, 'name' => 'Włostowska – Ryczek', 'rehabitation_center' => 3, 'specialization' => 2, 'is_accepted' => 1, 'date_of_acceptance' => '2021-03-03', 'status' => 1],
            ['id' => 96, 'name' => 'Małgorzata Szwemin', 'rehabitation_center' => 3, 'specialization' => 2, 'is_accepted' => 1, 'date_of_acceptance' => '2021-03-03', 'status' => 1],
            ['id' => 97, 'name' => 'Marzena Felczak Skrok', 'rehabitation_center' => 3, 'specialization' => 2, 'is_accepted' => 1, 'date_of_acceptance' => '2021-03-03', 'status' => 1],
            ['id' => 98, 'name' => 'Monika Toć', 'rehabitation_center' => 3, 'specialization' => 2, 'is_accepted' => 1, 'date_of_acceptance' => '2021-03-03', 'status' => 1],
            ['id' => 99, 'name' => 'Adam Oskęda', 'rehabitation_center' => 3, 'specialization' => 13, 'is_accepted' => 1, 'date_of_acceptance' => '2021-03-03', 'status' => 1],
            ['id' => 100, 'name' => 'Anna Gańko', 'rehabitation_center' => 3, 'specialization' => 13, 'is_accepted' => 1, 'date_of_acceptance' => '2021-03-03', 'status' => 1],
            ['id' => 101, 'name' => 'Matylda Szalawska', 'rehabitation_center' => 3, 'specialization' => 13, 'is_accepted' => 1, 'date_of_acceptance' => '2021-03-03', 'status' => 1],
            ['id' => 102, 'name' => 'Maciej Bedkowski', 'rehabitation_center' => 3, 'specialization' => 6, 'is_accepted' => 1, 'date_of_acceptance' => '2021-03-03', 'status' => 1],
            ['id' => 103, 'name' => 'Joanna Rokicka', 'rehabitation_center' => 3, 'specialization' => 14, 'is_accepted' => 1, 'date_of_acceptance' => '2021-03-03', 'status' => 1],
            ['id' => 104, 'name' => 'Monika Ładno', 'rehabitation_center' => 3, 'specialization' => 14, 'is_accepted' => 1, 'date_of_acceptance' => '2021-03-03', 'status' => 1],
            ['id' => 105, 'name' => 'Tomasz Augustyniak', 'rehabitation_center' => 3, 'specialization' => 14, 'is_accepted' => 1, 'date_of_acceptance' => '2021-03-03', 'status' => 1],
            ['id' => 106, 'name' => 'Anna Nowosal', 'rehabitation_center' => 3, 'specialization' => 14, 'is_accepted' => 1, 'date_of_acceptance' => '2021-03-03', 'status' => 1],
            ['id' => 107, 'name' => 'Małgorzata Matosek', 'rehabitation_center' => 3, 'specialization' => 8, 'is_accepted' => 1, 'date_of_acceptance' => '2021-03-03', 'status' => 1],
            ['id' => 108, 'name' => 'Agnieszka Stefanowska', 'rehabitation_center' => 3, 'specialization' => 8, 'is_accepted' => 1, 'date_of_acceptance' => '2021-03-03', 'status' => 1],
            ['id' => 109, 'name' => 'Urszula Jóźwicka', 'rehabitation_center' => 3, 'specialization' => 8, 'is_accepted' => 1, 'date_of_acceptance' => '2021-03-03', 'status' => 1],
            ['id' => 110, 'name' => 'Anna Maria Jabłońska', 'rehabitation_center' => 3, 'specialization' => 8, 'is_accepted' => 1, 'date_of_acceptance' => '2021-03-03', 'status' => 1],
            ['id' => 111, 'name' => 'Magdalena Boryszewska', 'rehabitation_center' => 3, 'specialization' => 8, 'is_accepted' => 1, 'date_of_acceptance' => '2021-03-03', 'status' => 1],
            ['id' => 112, 'name' => 'Alicja Halaburda', 'rehabitation_center' => 3, 'specialization' => 15, 'is_accepted' => 1, 'date_of_acceptance' => '2021-03-03', 'status' => 1],
            ['id' => 113, 'name' => 'Agnieszka Bryk', 'rehabitation_center' => 3, 'specialization' => 15, 'is_accepted' => 1, 'date_of_acceptance' => '2021-03-03', 'status' => 1],
            ['id' => 114, 'name' => 'Agnieszka Głuchowska', 'rehabitation_center' => 3, 'specialization' => 15, 'is_accepted' => 1, 'date_of_acceptance' => '2021-03-03', 'status' => 1],
            ['id' => 115, 'name' => 'Katarzyna Wołkiewicz', 'rehabitation_center' => 3, 'specialization' => 10, 'is_accepted' => 1, 'date_of_acceptance' => '2021-03-03', 'status' => 1],
            ['id' => 116, 'name' => 'Anna Olesińska', 'rehabitation_center' => 3, 'specialization' => 16, 'is_accepted' => 1, 'date_of_acceptance' => '2021-03-03', 'status' => 1],
            ['id' => 117, 'name' => 'Marta Drela', 'rehabitation_center' => 3, 'specialization' => 16, 'is_accepted' => 1, 'date_of_acceptance' => '2021-03-03', 'status' => 1],
            ['id' => 118, 'name' => 'Elżbieta Wójcik', 'rehabitation_center' => 4, 'specialization' => 1, 'is_accepted' => 1, 'date_of_acceptance' => '2021-03-03', 'status' => 1],
            ['id' => 119, 'name' => 'Anna Kolibska', 'rehabitation_center' => 4, 'specialization' => 1, 'is_accepted' => 1, 'date_of_acceptance' => '2021-03-03', 'status' => 1],
            ['id' => 120, 'name' => 'Anna Lewandowska', 'rehabitation_center' => 4, 'specialization' => 1, 'is_accepted' => 1, 'date_of_acceptance' => '2021-03-03', 'status' => 1],
            ['id' => 121, 'name' => 'Dorota Laska', 'rehabitation_center' => 4, 'specialization' => 1, 'is_accepted' => 1, 'date_of_acceptance' => '2021-03-03', 'status' => 1],
            ['id' => 122, 'name' => 'Anna Szymczyk', 'rehabitation_center' => 4, 'specialization' => 1, 'is_accepted' => 1, 'date_of_acceptance' => '2021-03-03', 'status' => 1],
            ['id' => 123, 'name' => 'Tomasz Gierwatowski', 'rehabitation_center' => 4, 'specialization' => 17, 'is_accepted' => 1, 'date_of_acceptance' => '2021-03-03', 'status' => 1],
            ['id' => 124, 'name' => 'Stanisław Podlaski', 'rehabitation_center' => 4, 'specialization' => 3, 'is_accepted' => 1, 'date_of_acceptance' => '2021-03-03', 'status' => 1],
            ['id' => 125, 'name' => 'Małgorzata Drozd', 'rehabitation_center' => 4, 'specialization' => 3, 'is_accepted' => 1, 'date_of_acceptance' => '2021-03-03', 'status' => 1],
            ['id' => 126, 'name' => 'Ilona Jarecka', 'rehabitation_center' => 4, 'specialization' => 3, 'is_accepted' => 1, 'date_of_acceptance' => '2021-03-03', 'status' => 1],
            ['id' => 127, 'name' => 'Przemysław Laskowski', 'rehabitation_center' => 4, 'specialization' => 3, 'is_accepted' => 1, 'date_of_acceptance' => '2021-03-03', 'status' => 1],
            ['id' => 128, 'name' => 'Łukasz Łukasik', 'rehabitation_center' => 4, 'specialization' => 3, 'is_accepted' => 1, 'date_of_acceptance' => '2021-03-03', 'status' => 1],
            ['id' => 129, 'name' => 'Artur Witkowski', 'rehabitation_center' => 4, 'specialization' => 4, 'is_accepted' => 1, 'date_of_acceptance' => '2021-03-03', 'status' => 1],
            ['id' => 130, 'name' => 'Bogusław Drozd', 'rehabitation_center' => 4, 'specialization' => 4, 'is_accepted' => 1, 'date_of_acceptance' => '2021-03-03', 'status' => 1],
            ['id' => 131, 'name' => 'Renata Czeronko', 'rehabitation_center' => 4, 'specialization' => 4, 'is_accepted' => 1, 'date_of_acceptance' => '2021-03-03', 'status' => 1],
            ['id' => 132, 'name' => 'Łukasz Łukasik', 'rehabitation_center' => 4, 'specialization' => 4, 'is_accepted' => 1, 'date_of_acceptance' => '2021-03-03', 'status' => 1],
            ['id' => 133, 'name' => 'Przemysław Laskowski', 'rehabitation_center' => 4, 'specialization' => 4, 'is_accepted' => 1, 'date_of_acceptance' => '2021-03-03', 'status' => 1],
            ['id' => 134, 'name' => 'Katarzyna Wac', 'rehabitation_center' => 4, 'specialization' => 2, 'is_accepted' => 1, 'date_of_acceptance' => '2021-03-03', 'status' => 1],
            ['id' => 135, 'name' => 'Agata Włostowska-Ryczek', 'rehabitation_center' => 4, 'specialization' => 2, 'is_accepted' => 1, 'date_of_acceptance' => '2021-03-03', 'status' => 1],
            ['id' => 136, 'name' => 'Monika Toć', 'rehabitation_center' => 4, 'specialization' => 2, 'is_accepted' => 1, 'date_of_acceptance' => '2021-03-03', 'status' => 1],
            ['id' => 137, 'name' => 'Monika Syroka Oroń', 'rehabitation_center' => 4, 'specialization' => 2, 'is_accepted' => 1, 'date_of_acceptance' => '2021-03-03', 'status' => 1],
            ['id' => 138, 'name' => 'Tomasz Olszewski', 'rehabitation_center' => 4, 'specialization' => 6, 'is_accepted' => 1, 'date_of_acceptance' => '2021-03-03', 'status' => 1],
            ['id' => 139, 'name' => 'Mariusz Wronisz', 'rehabitation_center' => 4, 'specialization' => 6, 'is_accepted' => 1, 'date_of_acceptance' => '2021-03-03', 'status' => 1],
            ['id' => 140, 'name' => 'Piotr Olszak', 'rehabitation_center' => 4, 'specialization' => 6, 'is_accepted' => 1, 'date_of_acceptance' => '2021-03-03', 'status' => 1],
            ['id' => 141, 'name' => 'Anna Szymczyk', 'rehabitation_center' => 4, 'specialization' => 8, 'is_accepted' => 1, 'date_of_acceptance' => '2021-03-03', 'status' => 1],
            ['id' => 142, 'name' => 'Izabela Młynek', 'rehabitation_center' => 4, 'specialization' => 8, 'is_accepted' => 1, 'date_of_acceptance' => '2021-03-03', 'status' => 1],
            ['id' => 143, 'name' => 'Tomasz Buda', 'rehabitation_center' => 4, 'specialization' => 14, 'is_accepted' => 1, 'date_of_acceptance' => '2021-03-03', 'status' => 1],
            ['id' => 144, 'name' => 'Małgorzata Kepa', 'rehabitation_center' => 4, 'specialization' => 14, 'is_accepted' => 1, 'date_of_acceptance' => '2021-03-03', 'status' => 1],
            ['id' => 145, 'name' => 'Łukasz Duda', 'rehabitation_center' => 4, 'specialization' => 14, 'is_accepted' => 1, 'date_of_acceptance' => '2021-03-03', 'status' => 1],
            ['id' => 146, 'name' => 'Małgorzata Kowalska Bakalarz', 'rehabitation_center' => 4, 'specialization' => 14, 'is_accepted' => 1, 'date_of_acceptance' => '2021-03-03', 'status' => 1],
            ['id' => 147, 'name' => 'Krzysztof Bisek', 'rehabitation_center' => 4, 'specialization' => 14, 'is_accepted' => 1, 'date_of_acceptance' => '2021-03-03', 'status' => 1],
            ['id' => 148, 'name' => 'Artur Mańka', 'rehabitation_center' => 4, 'specialization' => 14, 'is_accepted' => 1, 'date_of_acceptance' => '2021-03-03', 'status' => 1],
            ['id' => 149, 'name' => 'Barbara Pomorska', 'rehabitation_center' => 4, 'specialization' => 15, 'is_accepted' => 1, 'date_of_acceptance' => '2021-03-03', 'status' => 1],
            ['id' => 150, 'name' => 'Mieczysława Jędrusińska', 'rehabitation_center' => 4, 'specialization' => 15, 'is_accepted' => 1, 'date_of_acceptance' => '2021-03-03', 'status' => 1],
            ['id' => 151, 'name' => 'Anna Nadulska', 'rehabitation_center' => 4, 'specialization' => 9, 'is_accepted' => 1, 'date_of_acceptance' => '2021-03-03', 'status' => 1],
            ['id' => 152, 'name' => 'Kamila Stańczyk', 'rehabitation_center' => 4, 'specialization' => 16, 'is_accepted' => 1, 'date_of_acceptance' => '2021-03-03', 'status' => 1],
            ['id' => 153, 'name' => 'Beata Wieczerzak', 'rehabitation_center' => 4, 'specialization' => 16, 'is_accepted' => 1, 'date_of_acceptance' => '2021-03-03', 'status' => 1],
        ];
        foreach($items as $item)
        {
            \App\Models\OrkTeam::create($item);
        }
    }
}
