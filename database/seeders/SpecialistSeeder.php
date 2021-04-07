<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class SpecialistSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $items = [
            ["id" => 1, "name" =>"Agnieszka Grzeszczuk", "qualification_point" =>7,"specialty" => 2,"status" => 1],
            ["id" => 2, "name" =>"Joanna Eliasz – Kosińska", "qualification_point" =>7,"specialty" => 2,"status" => 1],
            ["id" => 3, "name" =>"Ewa Lisiecka", "qualification_point" =>8,"specialty" => 2,"status" => 1],
            ["id" => 4, "name" =>"Maria Szeliga-Cetnarska", "qualification_point" =>8,"specialty" => 2,"status" => 1],
            ["id" => 5, "name" =>"Elżbieta Łukasik", "qualification_point" =>9,"specialty" => 2,"status" => 1],
            ["id" => 6, "name" =>"Mirosław Lekan", "qualification_point" =>9,"specialty" => 2,"status" => 1],
            ["id" => 7, "name" =>"Agnieszka Olechnicka", "qualification_point" =>10,"specialty" => 2,"status" => 1],
            ["id" => 8, "name" =>"Leszek Strzelczyk", "qualification_point" =>11,"specialty" => 2,"status" => 1],
            ["id" => 9, "name" =>"Beata Michna", "qualification_point" =>12,"specialty" => 2,"status" => 1],
            ["id" => 10, "name" =>"Anita Rembiecha", "qualification_point" =>12,"specialty" => 2,"status" => 1],
            ["id" => 11, "name" =>"Dariusz Musiorski", "qualification_point" =>13,"specialty" => 2,"status" => 1],
            ["id" => 12, "name" =>"Witold Radzioch", "qualification_point" =>13,"specialty" => 2,"status" => 1],
            ["id" => 13, "name" =>"Magdalena Bocianowska", "qualification_point" =>13,"specialty" => 2,"status" => 1],
            ["id" => 14, "name" =>"Wiesława Jakszuk", "qualification_point" =>15,"specialty" => 2,"status" => 1],
            ["id" => 15, "name" =>"Jacek Sawicki", "qualification_point" =>14,"specialty" => 2,"status" => 1],
            ["id" => 16, "name" =>"Irena Florin-Dziopa", "qualification_point" =>3,"specialty" => 2,"status" => 1],
            ["id" => 17, "name" =>"Anna Szczygłowska Wrona", "qualification_point" =>3,"specialty" => 2,"status" => 1],
            ["id" => 18, "name" =>"Halina Kurgan-Simlat", "qualification_point" =>17,"specialty" => 2,"status" => 1],
            ["id" => 19, "name" =>"Marzena Czarecka-Majerowska", "qualification_point" =>4,"specialty" => 2,"status" => 1],
            ["id" => 20, "name" =>"Wioleta Perzyńska", "qualification_point" =>19,"specialty" => 2,"status" => 1],
            ["id" => 21, "name" =>"Tomasz Jezierski", "qualification_point" =>20,"specialty" => 2,"status" => 1],
            ["id" => 22, "name" =>"Krzysztof Musiatowicz", "qualification_point" =>21,"specialty" => 2,"status" => 1],
            ["id" => 23, "name" =>"Iwona Kibiłda", "qualification_point" =>21,"specialty" => 2,"status" => 1],
            ["id" => 24, "name" =>"Tomasz Adolf", "qualification_point" =>22,"specialty" => 2,"status" => 1],
            ["id" => 25, "name" =>"Anna Sulikowska", "qualification_point" =>23,"specialty" => 2,"status" => 1],
            ["id" => 26, "name" =>"Barbara Wrzeciono", "qualification_point" =>23,"specialty" => 2,"status" => 1],
            ["id" => 27, "name" =>"Małgorzata Mikołajczyk", "qualification_point" =>24,"specialty" => 2,"status" => 1],
            ["id" => 28, "name" =>"Dariusz Kałwak", "qualification_point" =>25,"specialty" => 2,"status" => 1],
            ["id" => 29, "name" =>"Barbara Ciebiera- Djelassi", "qualification_point" =>26,"specialty" => 2,"status" => 1],
            ["id" => 30, "name" =>"Grażyna Grabowska –Dampc", "qualification_point" =>26,"specialty" => 2,"status" => 1],
            ["id" => 31, "name" =>"Danuta Wróblewska", "qualification_point" =>27,"specialty" => 2,"status" => 1],
            ["id" => 32, "name" =>"Anna Galanty", "qualification_point" =>27,"specialty" => 2,"status" => 1],
            ["id" => 33, "name" =>"Jacek Balicki", "qualification_point" =>28,"specialty" => 2,"status" => 1],
            ["id" => 34, "name" =>"Ewa Szmal – Przybyła", "qualification_point" =>29,"specialty" => 2,"status" => 1],
            ["id" => 35, "name" =>"Małgorzata Dziewanowska", "qualification_point" =>29,"specialty" => 2,"status" => 1],
            ["id" => 36, "name" =>"Dr n. med. Marek Cieślak", "qualification_point" =>31,"specialty" => 2,"status" => 1],
            ["id" => 37, "name" =>"Kamil Sokołowski", "qualification_point" =>31,"specialty" => 2,"status" => 1],
            ["id" => 38, "name" =>"Jolanta Zapart", "qualification_point" =>32,"specialty" => 2,"status" => 1],
            ["id" => 39, "name" =>"Anna Wrońska", "qualification_point" =>32,"specialty" => 2,"status" => 1],
            ["id" => 40, "name" =>"Eliza Smółkowska", "qualification_point" =>33,"specialty" => 2,"status" => 1],
            ["id" => 41, "name" =>"Dorota Szelągowska", "qualification_point" =>33,"specialty" => 2,"status" => 1],
            ["id" => 42, "name" =>"Katarzyna Kalbowiak", "qualification_point" =>33,"specialty" => 2,"status" => 1],
            ["id" => 43, "name" =>"Ewa Mularonek", "qualification_point" =>34,"specialty" => 2,"status" => 1],
            ["id" => 44, "name" =>"Jadwiga Kowalska", "qualification_point" =>34,"specialty" => 2,"status" => 1],
            ["id" => 45, "name" =>"Igor Kosowicz", "qualification_point" =>35,"specialty" => 2,"status" => 1],
            ["id" => 46, "name" =>"Jarosław Gęszka", "qualification_point" =>1,"specialty" => 3,"status" => 1],
            ["id" => 47, "name" =>"Mirella Wojtecka-Grabka", "qualification_point" =>3,"specialty" => 3,"status" => 1],
            ["id" => 48, "name" =>"Tomasz Lübek", "qualification_point" =>4,"specialty" => 3,"status" => 1],
            ["id" => 49, "name" =>"Jarosław Gęszka", "qualification_point" =>22,"specialty" => 3,"status" => 1],
            ["id" => 50, "name" =>"Renata Szczupak-Orłowska", "qualification_point" =>5,"specialty" => 3,"status" => 1],
            ["id" => 51, "name" =>"Andrzej Kozyrski", "qualification_point" =>33,"specialty" => 3,"status" => 1],
            ["id" => 52, "name" =>"Małgorzata Strzelczyk", "qualification_point" =>8,"specialty" => 1,"status" => 1],
            ["id" => 53, "name" =>"Paweł Przytuła", "qualification_point" =>9,"specialty" => 1,"status" => 1],
            ["id" => 54, "name" =>"Marlena Steglińska", "qualification_point" =>10,"specialty" => 1,"status" => 1],
            ["id" => 55, "name" =>"Małgorzata Strzelczyk", "qualification_point" =>11,"specialty" => 1,"status" => 1],
            ["id" => 56, "name" =>"Marta Wyszyńska – Słota", "qualification_point" =>12,"specialty" => 1,"status" => 1],
            ["id" => 57, "name" =>"Agnieszka Miklewska", "qualification_point" =>13,"specialty" => 1,"status" => 1],
            ["id" => 58, "name" =>"Magdalena Żołno", "qualification_point" =>15,"specialty" => 1,"status" => 1],
            ["id" => 59, "name" =>"Hubert Kulik", "qualification_point" =>14,"specialty" => 1,"status" => 1],
            ["id" => 60, "name" =>"Małgorzata Czapla", "qualification_point" =>16,"specialty" => 1,"status" => 1],
            ["id" => 61, "name" =>"Karol Stańczyk", "qualification_point" =>17,"specialty" => 1,"status" => 1],
            ["id" => 62, "name" =>"Aneta Perzyńska-Starkiewicz", "qualification_point" =>4,"specialty" => 1,"status" => 1],
            ["id" => 63, "name" =>"Marta Odyniec", "qualification_point" =>19,"specialty" => 1,"status" => 1],
            ["id" => 64, "name" =>"Katarzyna Chwieduk", "qualification_point" =>21,"specialty" => 1,"status" => 1],
            ["id" => 65, "name" =>"Dawid Kłapkowski", "qualification_point" =>22,"specialty" => 1,"status" => 1],
            ["id" => 66, "name" =>"Aleksander Gryszczenia", "qualification_point" =>5,"specialty" => 1,"status" => 1],
            ["id" => 67, "name" =>"Elżbieta Stachera", "qualification_point" =>5,"specialty" => 1,"status" => 1],
            ["id" => 68, "name" =>"Iwona Bernaciak", "qualification_point" =>24,"specialty" => 1,"status" => 1],
            ["id" => 69, "name" =>"Aleksandra Kaczmarczyk", "qualification_point" =>25,"specialty" => 1,"status" => 1],
            ["id" => 70, "name" =>"Elżbieta Gruca-Bielenda", "qualification_point" =>26,"specialty" => 1,"status" => 1],
            ["id" => 71, "name" =>"Iwona Bernaciak", "qualification_point" =>27,"specialty" => 1,"status" => 1],
            ["id" => 72, "name" =>"Hubert Kulik", "qualification_point" =>28,"specialty" => 1,"status" => 1],
            ["id" => 73, "name" =>"Małgorzata Strzelczyk", "qualification_point" =>29,"specialty" => 1,"status" => 1],
            ["id" => 74, "name" =>"Marlena Steglińska", "qualification_point" =>31,"specialty" => 1,"status" => 1],
            ["id" => 75, "name" =>"Iwona Bernaciak", "qualification_point" =>33,"specialty" => 1,"status" => 1],
            ["id" => 76, "name" =>"Grażyna Greń", "qualification_point" =>34,"specialty" => 1,"status" => 1],
            ["id" => 77, "name" =>"Krystyna Jędrzejak", "qualification_point" =>35,"specialty" => 1,"status" => 1],
            ["id" => 78, "name" =>"Małgorzata Strzelczyk", "qualification_point" =>8,"specialty" => 2,"status" => 1],
            ["id" => 79, "name" =>"Paweł Przytuła", "qualification_point" =>9,"specialty" => 2,"status" => 1],
            ["id" => 80, "name" =>"Marlena Steglińska", "qualification_point" =>10,"specialty" => 2,"status" => 1],
            ["id" => 81, "name" =>"Małgorzata Strzelczyk", "qualification_point" =>11,"specialty" => 2,"status" => 1],
            ["id" => 82, "name" =>"Marta Wyszyńska – Słota", "qualification_point" =>12,"specialty" => 2,"status" => 1],
            ["id" => 83, "name" =>"Agnieszka Miklewska", "qualification_point" =>13,"specialty" => 2,"status" => 1],
            ["id" => 84, "name" =>"Magdalena Żołno", "qualification_point" =>15,"specialty" => 2,"status" => 1],
            ["id" => 85, "name" =>"Hubert Kulik", "qualification_point" =>14,"specialty" => 2,"status" => 1],
            ["id" => 86, "name" =>"Małgorzata Czapla", "qualification_point" =>16,"specialty" => 2,"status" => 1],
            ["id" => 87, "name" =>"Karol Stańczyk", "qualification_point" =>17,"specialty" => 2,"status" => 1],
            ["id" => 88, "name" =>"Aneta Perzyńska-Starkiewicz", "qualification_point" =>4,"specialty" => 2,"status" => 1],
            ["id" => 89, "name" =>"Marta Odyniec", "qualification_point" =>19,"specialty" => 2,"status" => 1],
            ["id" => 90, "name" =>"Katarzyna Chwieduk", "qualification_point" =>21,"specialty" => 2,"status" => 1],
            ["id" => 91, "name" =>"Dawid Kłapkowski", "qualification_point" =>22,"specialty" => 2,"status" => 1],
            ["id" => 92, "name" =>"Aleksander Gryszczenia", "qualification_point" =>5,"specialty" => 2,"status" => 1],
            ["id" => 93, "name" =>"Elżbieta Stachera", "qualification_point" =>5,"specialty" => 2,"status" => 1],
            ["id" => 94, "name" =>"Iwona Bernaciak", "qualification_point" =>24,"specialty" => 2,"status" => 1],
            ["id" => 95, "name" =>"Aleksandra Kaczmarczyk", "qualification_point" =>25,"specialty" => 2,"status" => 1],
            ["id" => 96, "name" =>"Elżbieta Gruca-Bielenda", "qualification_point" =>26,"specialty" => 2,"status" => 1],
            ["id" => 97, "name" =>"Iwona Bernaciak", "qualification_point" =>27,"specialty" => 2,"status" => 1],
            ["id" => 98, "name" =>"Hubert Kulik", "qualification_point" =>28,"specialty" => 2,"status" => 1],
            ["id" => 99, "name" =>"Małgorzata Strzelczyk", "qualification_point" =>29,"specialty" => 2,"status" => 1],
            ["id" => 100, "name" =>"Marlena Steglińska", "qualification_point" =>31,"specialty" => 2,"status" => 1],
            ["id" => 101, "name" =>"Iwona Bernaciak", "qualification_point" =>33,"specialty" => 2,"status" => 1],
            ["id" => 102, "name" =>"Grażyna Greń", "qualification_point" =>34,"specialty" => 2,"status" => 1],
            ["id" => 103, "name" =>"Krystyna Jędrzejak", "qualification_point" =>35,"specialty" => 2,"status" => 1],
            ["id" => 104, "name" =>"Małgorzata Strzelczyk", "qualification_point" =>8,"specialty" => 3,"status" => 1],
            ["id" => 105, "name" =>"Paweł Przytuła", "qualification_point" =>9,"specialty" => 3,"status" => 1],
            ["id" => 106, "name" =>"Marlena Steglińska", "qualification_point" =>10,"specialty" => 3,"status" => 1],
            ["id" => 107, "name" =>"Małgorzata Strzelczyk", "qualification_point" =>11,"specialty" => 3,"status" => 1],
            ["id" => 108, "name" =>"Marta Wyszyńska – Słota", "qualification_point" =>12,"specialty" => 3,"status" => 1],
            ["id" => 109, "name" =>"Agnieszka Miklewska", "qualification_point" =>13,"specialty" => 3,"status" => 1],
            ["id" => 110, "name" =>"Magdalena Żołno", "qualification_point" =>15,"specialty" => 3,"status" => 1],
            ["id" => 111, "name" =>"Hubert Kulik", "qualification_point" =>14,"specialty" => 3,"status" => 1],
            ["id" => 112, "name" =>"Małgorzata Czapla", "qualification_point" =>16,"specialty" => 3,"status" => 1],
            ["id" => 113, "name" =>"Karol Stańczyk", "qualification_point" =>17,"specialty" => 3,"status" => 1],
            ["id" => 114, "name" =>"Aneta Perzyńska-Starkiewicz", "qualification_point" =>4,"specialty" => 3,"status" => 1],
            ["id" => 115, "name" =>"Marta Odyniec", "qualification_point" =>19,"specialty" => 3,"status" => 1],
            ["id" => 116, "name" =>"Katarzyna Chwieduk", "qualification_point" =>21,"specialty" => 3,"status" => 1],
            ["id" => 117, "name" =>"Dawid Kłapkowski", "qualification_point" =>22,"specialty" => 3,"status" => 1],
            ["id" => 118, "name" =>"Aleksander Gryszczenia", "qualification_point" =>5,"specialty" => 3,"status" => 1],
            ["id" => 119, "name" =>"Elżbieta Stachera", "qualification_point" =>5,"specialty" => 3,"status" => 1],
            ["id" => 120, "name" =>"Iwona Bernaciak", "qualification_point" =>24,"specialty" => 3,"status" => 1],
            ["id" => 121, "name" =>"Aleksandra Kaczmarczyk", "qualification_point" =>25,"specialty" => 3,"status" => 1],
            ["id" => 122, "name" =>"Elżbieta Gruca-Bielenda", "qualification_point" =>26,"specialty" => 3,"status" => 1],
            ["id" => 123, "name" =>"Iwona Bernaciak", "qualification_point" =>27,"specialty" => 3,"status" => 1],
            ["id" => 124, "name" =>"Hubert Kulik", "qualification_point" =>28,"specialty" => 3,"status" => 1],
            ["id" => 125, "name" =>"Małgorzata Strzelczyk", "qualification_point" =>29,"specialty" => 3,"status" => 1],
            ["id" => 126, "name" =>"Marlena Steglińska", "qualification_point" =>31,"specialty" => 3,"status" => 1],
            ["id" => 127, "name" =>"Iwona Bernaciak", "qualification_point" =>33,"specialty" => 3,"status" => 1],
            ["id" => 128, "name" =>"Grażyna Greń", "qualification_point" =>34,"specialty" => 3,"status" => 1],
            ["id" => 129, "name" =>"Krystyna Jędrzejak", "qualification_point" =>35,"specialty" => 3,"status" => 1],
            ["id" => 130, "name" =>"Małgorzata Strzelczyk", "qualification_point" =>8,"specialty" => 4,"status" => 1],
            ["id" => 131, "name" =>"Paweł Przytuła", "qualification_point" =>9,"specialty" => 4,"status" => 1],
            ["id" => 132, "name" =>"Marlena Steglińska", "qualification_point" =>10,"specialty" => 4,"status" => 1],
            ["id" => 133, "name" =>"Małgorzata Strzelczyk", "qualification_point" =>11,"specialty" => 4,"status" => 1],
            ["id" => 134, "name" =>"Marta Wyszyńska – Słota", "qualification_point" =>12,"specialty" => 4,"status" => 1],
            ["id" => 135, "name" =>"Agnieszka Miklewska", "qualification_point" =>13,"specialty" => 4,"status" => 1],
            ["id" => 136, "name" =>"Magdalena Żołno", "qualification_point" =>15,"specialty" => 4,"status" => 1],
            ["id" => 137, "name" =>"Hubert Kulik", "qualification_point" =>14,"specialty" => 4,"status" => 1],
            ["id" => 138, "name" =>"Małgorzata Czapla", "qualification_point" =>16,"specialty" => 4,"status" => 1],
            ["id" => 139, "name" =>"Karol Stańczyk", "qualification_point" =>17,"specialty" => 4,"status" => 1],
            ["id" => 140, "name" =>"Aneta Perzyńska-Starkiewicz", "qualification_point" =>4,"specialty" => 4,"status" => 1],
            ["id" => 141, "name" =>"Marta Odyniec", "qualification_point" =>19,"specialty" => 4,"status" => 1],
            ["id" => 142, "name" =>"Katarzyna Chwieduk", "qualification_point" =>21,"specialty" => 4,"status" => 1],
            ["id" => 143, "name" =>"Dawid Kłapkowski", "qualification_point" =>22,"specialty" => 4,"status" => 1],
            ["id" => 144, "name" =>"Aleksander Gryszczenia", "qualification_point" =>5,"specialty" => 4,"status" => 1],
            ["id" => 145, "name" =>"Elżbieta Stachera", "qualification_point" =>5,"specialty" => 4,"status" => 1],
            ["id" => 146, "name" =>"Iwona Bernaciak", "qualification_point" =>24,"specialty" => 4,"status" => 1],
            ["id" => 147, "name" =>"Aleksandra Kaczmarczyk", "qualification_point" =>25,"specialty" => 4,"status" => 1],
            ["id" => 148, "name" =>"Elżbieta Gruca-Bielenda", "qualification_point" =>26,"specialty" => 4,"status" => 1],
            ["id" => 149, "name" =>"Iwona Bernaciak", "qualification_point" =>27,"specialty" => 4,"status" => 1],
            ["id" => 150, "name" =>"Hubert Kulik", "qualification_point" =>28,"specialty" => 4,"status" => 1],
            ["id" => 151, "name" =>"Małgorzata Strzelczyk", "qualification_point" =>29,"specialty" => 4,"status" => 1],
            ["id" => 152, "name" =>"Marlena Steglińska", "qualification_point" =>31,"specialty" => 4,"status" => 1],
            ["id" => 153, "name" =>"Iwona Bernaciak", "qualification_point" =>33,"specialty" => 4,"status" => 1],
            ["id" => 154, "name" =>"Grażyna Greń", "qualification_point" =>34,"specialty" => 4,"status" => 1],
            ["id" => 155, "name" =>"Krystyna Jędrzejak", "qualification_point" =>35,"specialty" => 4,"status" => 1],
            ["id" => 156, "name" =>"Jarosław Gęszka", "qualification_point" =>36,"specialty" => 4,"status" => 1],
            ["id" => 157, "name" =>"Mateusz Hen", "qualification_point" =>36,"specialty" => 4,"status" => 1],
            ["id" => 158, "name" =>"Wanda Lusaw-Józefowicz", "qualification_point" =>37,"specialty" => 4,"status" => 1],
            ["id" => 159, "name" =>"Renata Ullmann", "qualification_point" =>38,"specialty" => 4,"status" => 1],
            ["id" => 160, "name" =>"Magdalena Kalinowska-Krasnowska", "qualification_point" =>39,"specialty" => 4,"status" => 1],
            ["id" => 161, "name" =>"Piotr Smogur", "qualification_point" =>40,"specialty" => 4,"status" => 1],
        ];
        foreach($items as $item)
        {
            \App\Models\Specialist::create($item);
        }
    }
}
