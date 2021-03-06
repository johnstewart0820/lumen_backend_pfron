<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class ServiceListSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $items = [
            ['id' => 1, 'number' => '1', 'name' => 'Diagnoza na wejściu - fizjoterapeuta', 'module' => 1, 'type' => 1, 'amount_usage' => '150', 'unit' => 2, 'amount_takes' => '', 'is_required' => 1, 'not_applicable' => 0, 'status' => 1],
            ['id' => 2, 'number' => '2', 'name' => 'Diagnoza na wejściu - doradca zawodowy', 'module' => 1, 'type' => 1, 'amount_usage' => '150', 'unit' => 2, 'amount_takes' => '', 'is_required' => 1, 'not_applicable' => 0, 'status' => 1],
            ['id' => 3, 'number' => '3', 'name' => 'Diagnoza na wejściu - psycholog', 'module' => 1, 'type' => 1, 'amount_usage' => '150', 'unit' => 2, 'amount_takes' => '', 'is_required' => 1, 'not_applicable' => 0, 'status' => 1],
            ['id' => 4, 'number' => '4', 'name' => 'Diagnoza w połowie pobytu - doradca zawodowy', 'module' => 1, 'type' => 1, 'amount_usage' => '150', 'unit' => 2, 'amount_takes' => '', 'is_required' => 1, 'not_applicable' => 0, 'status' => 1],
            ['id' => 5, 'number' => '5', 'name' => 'Diagnoza w połowie pobytu - psycholog', 'module' => 1, 'type' => 1, 'amount_usage' => '150', 'unit' => 2, 'amount_takes' => '', 'is_required' => 1, 'not_applicable' => 0, 'status' => 1],
            ['id' => 6, 'number' => '6', 'name' => 'Diagnoza na zakończenie - fizjoterapeuta', 'module' => 1, 'type' => 1, 'amount_usage' => '150', 'unit' => 2, 'amount_takes' => '', 'is_required' => 1, 'not_applicable' => 0, 'status' => 1],
            ['id' => 7, 'number' => '7', 'name' => 'Diagnoza na zakończenie - doradca zawodowy', 'module' => 1, 'type' => 1, 'amount_usage' => '150', 'unit' => 2, 'amount_takes' => '', 'is_required' => 1, 'not_applicable' => 0, 'status' => 1],
            ['id' => 8, 'number' => '8', 'name' => 'Diagnoza na zakończenie - psycholog', 'module' => 1, 'type' => 1, 'amount_usage' => '150', 'unit' => 2, 'amount_takes' => '', 'is_required' => 1, 'not_applicable' => 0, 'status' => 1],
            ['id' => 9, 'number' => '9', 'name' => 'Przygotowanie IPR - doradca zawodowy', 'module' => 1, 'type' => 1, 'amount_usage' => '150', 'unit' => 2, 'amount_takes' => '', 'is_required' => 1, 'not_applicable' => 0, 'status' => 1],
            ['id' => 10, 'number' => '10', 'name' => 'Przygotowanie IPR - pośrednik pracy', 'module' => 1, 'type' => 1, 'amount_usage' => '150', 'unit' => 2, 'amount_takes' => '', 'is_required' => 1, 'not_applicable' => 0, 'status' => 1],
            ['id' => 11, 'number' => '11', 'name' => 'Przygotowanie IPR - psycholog', 'module' => 1, 'type' => 1, 'amount_usage' => '150', 'unit' => 2, 'amount_takes' => '', 'is_required' => 1, 'not_applicable' => 0, 'status' => 1],
            ['id' => 12, 'number' => '12', 'name' => 'Działania aktywizujące - doradztwo zawodowe – indywidualne sesje z doradcą zawodowym', 'module' => 2, 'type' => 1, 'amount_usage' => '150', 'unit' => 2, 'amount_takes' => '', 'is_required' => 1, 'not_applicable' => 0, 'status' => 1],
            ['id' => 13, 'number' => '13', 'name' => 'Działania aktywizujące – warsztaty funkcjonowania na rynku pracy (grupy średnio 10 osobowe)', 'module' => 2, 'type' => 2, 'amount_usage' => '150', 'unit' => 3, 'amount_takes' => '', 'is_required' => 1, 'not_applicable' => 0, 'status' => 1],
            ['id' => 14, 'number' => '14', 'name' => 'Działania aktywizujące - wyrównywanie deficytów w obszarach edukacyjnym - warsztaty (grupy średnio 10 osobowe).', 'module' => 2, 'type' => 1, 'amount_usage' => '150', 'unit' => 3, 'amount_takes' => '', 'is_required' => 0, 'not_applicable' => 0, 'status' => 1],
            ['id' => 15, 'number' => '15', 'name' => 'Działania aktywizujące - wzmocnienie kompetencji ICT – szkolenia (grupy średnio 10 osobowe)', 'module' => 2, 'type' => 2, 'amount_usage' => '150', 'unit' => 3, 'amount_takes' => '', 'is_required' => 1, 'not_applicable' => 0, 'status' => 1],
            ['id' => 16, 'number' => '16', 'name' => 'Przekwalifikowanie zawodowe – szkolenia Wariant 1 (grupy średnio 10 osobowe)', 'module' => 2, 'type' => 2, 'amount_usage' => '90', 'unit' => 3, 'amount_takes' => '', 'is_required' => 1, 'not_applicable' => 0, 'status' => 1],
            ['id' => 17, 'number' => '17', 'name' => 'Przekwalifikowanie zawodowe – szkolenia Wariant 2 (grupy średnio 10 osobowe).', 'module' => 2, 'type' => 2, 'amount_usage' => '60', 'unit' => 3, 'amount_takes' => '', 'is_required' => 0, 'not_applicable' => 0, 'status' => 1],
            ['id' => 18, 'number' => '18', 'name' => 'Pośrednictwo pracy - spotkania indywidualne z Uczestnikami', 'module' => 2, 'type' => 1, 'amount_usage' => '150', 'unit' => 2, 'amount_takes' => '', 'is_required' => 1, 'not_applicable' => 0, 'status' => 1],
            ['id' => 19, 'number' => '19', 'name' => 'Pośrednictwo pracy - współpraca z pracodawcami - spotkania indywidualne i grupowe', 'module' => 2, 'type' => 1, 'amount_usage' => '', 'unit' => 2, 'amount_takes' => '', 'is_required' => 0, 'not_applicable' => 0, 'status' => 1],
            ['id' => 20, 'number' => '20', 'name' => 'Koszt badań lekarskich wymaganych przed podjęciem szkoleń (w zależności od planowanego stanowiska pracy)', 'module' => 2, 'type' => 1, 'amount_usage' => '150', 'unit' => 8, 'amount_takes' => '', 'is_required' => 0, 'not_applicable' => 0, 'status' => 1],
            ['id' => 21, 'number' => '21', 'name' => 'Działania upowszechniające wśród pracodawców', 'module' => 2, 'type' => 1, 'amount_usage' => '', 'unit' => 1, 'amount_takes' => '', 'is_required' => 0, 'not_applicable' => 0, 'status' => 1],
            ['id' => 22, 'number' => '22', 'name' => 'Sesje indywidualne z psychologiem', 'module' => 3, 'type' => 1, 'amount_usage' => '150', 'unit' => 2, 'amount_takes' => '', 'is_required' => 1, 'not_applicable' => 0, 'status' => 1],
            ['id' => 23, 'number' => '23', 'name' => 'Warsztaty grupowe (grupy średnio 10 osobowe)', 'module' => 3, 'type' => 2, 'amount_usage' => '150', 'unit' => 2, 'amount_takes' => '', 'is_required' => 1, 'not_applicable' => 0, 'status' => 1],
            ['id' => 24, 'number' => '24', 'name' => 'Spotkania indywidualne z członkami rodzin/bliskimi', 'module' => 3, 'type' => 1, 'amount_usage' => '150', 'unit' => 2, 'amount_takes' => '', 'is_required' => 0, 'not_applicable' => 0, 'status' => 1],
            ['id' => 25, 'number' => '25', 'name' => 'Warsztaty z rodzinami/bliskimi (grupy średnio 25 osobowe, 2 osoby na Uczestnika = Uczestnik + osoba bliska)', 'module' => 3, 'type' => 2, 'amount_usage' => '', 'unit' => 6, 'amount_takes' => '', 'is_required' => 0, 'not_applicable' => 0, 'status' => 1],
            ['id' => 26, 'number' => '26', 'name' => 'Działania integracyjne dla Uczestników', 'module' => 3, 'type' => 1, 'amount_usage' => '150', 'unit' => 7, 'amount_takes' => '', 'is_required' => 0, 'not_applicable' => 0, 'status' => 1],
            ['id' => 27, 'number' => '27a', 'name' => 'Opieka lekarska – opieka w trybie ciągłym (w ramach pracy gabinetu)', 'module' => 4, 'type' => 1, 'amount_usage' => '', 'unit' => 5, 'amount_takes' => '', 'is_required' => 0, 'not_applicable' => 0, 'status' => 1],
            ['id' => 28, 'number' => '27b', 'name' => 'Opieka lekarska – opieka w trybie ciągłym (w ramach pracy gabinetu)', 'module' => 4, 'type' => 1, 'amount_usage' => '', 'unit' => 5, 'amount_takes' => '', 'is_required' => 0, 'not_applicable' => 0, 'status' => 1],
            ['id' => 29, 'number' => '27c', 'name' => 'Opieka lekarska – opieka w trybie ciągłym (w ramach pracy gabinetu)', 'module' => 4, 'type' => 1, 'amount_usage' => '', 'unit' => 5, 'amount_takes' => '', 'is_required' => 0, 'not_applicable' => 0, 'status' => 1],
            ['id' => 30, 'number' => '28', 'name' => 'Rehabilitacja - zajęcia indywidualnie', 'module' => 4, 'type' => 1, 'amount_usage' => '150', 'unit' => 2, 'amount_takes' => '', 'is_required' => 1, 'not_applicable' => 0, 'status' => 1],
            ['id' => 31, 'number' => '29', 'name' => 'Rehabilitacja - zajęcia grupowe (grupy średnio 6 osobowe)', 'module' => 4, 'type' => 2, 'amount_usage' => '150', 'unit' => 2, 'amount_takes' => '', 'is_required' => 1, 'not_applicable' => 0, 'status' => 1],
            ['id' => 32, 'number' => '30', 'name' => 'Wsparcie lekarskie - specjalistyczne', 'module' => 5, 'type' => 1, 'amount_usage' => '150', 'unit' => 2, 'amount_takes' => '', 'is_required' => 0, 'not_applicable' => 0, 'status' => 1],
            ['id' => 33, 'number' => '31', 'name' => 'Inne konsultacje specjalistyczne', 'module' => 5, 'type' => 1, 'amount_usage' => '150', 'unit' => 2, 'amount_takes' => '', 'is_required' => 0, 'not_applicable' => 0, 'status' => 1],
            ['id' => 34, 'number' => '32', 'name' => 'Wsparcie indywidualne uzależnione od potrzeb uczestnika', 'module' => 5, 'type' => 1, 'amount_usage' => '', 'unit' => 2, 'amount_takes' => '', 'is_required' => 0, 'not_applicable' => 0, 'status' => 1],
            ['id' => 35, 'number' => '33', 'name' => 'Nocleg dla uczestników stacjonarnych', 'module' => 6, 'type' => 1, 'amount_usage' => '90', 'unit' => 9, 'amount_takes' => '', 'is_required' => 0, 'not_applicable' => 0, 'status' => 1],
            ['id' => 36, 'number' => '34', 'name' => 'Wyżywienie (śniadanie, przerwy kawowe, obiad i kolacja) dla uczestników stacjonarnych)', 'module' => 6, 'type' => 1, 'amount_usage' => '90', 'unit' => 10, 'amount_takes' => '', 'is_required' => 0, 'not_applicable' => 0, 'status' => 1],
            ['id' => 37, 'number' => '35', 'name' => 'Wyżywienie (przerwy kawowe i obiad) dla uczestników niestacjonarnych', 'module' => 6, 'type' => 1, 'amount_usage' => '60', 'unit' => 10, 'amount_takes' => '', 'is_required' => 0, 'not_applicable' => 0, 'status' => 1],
            ['id' => 38, 'number' => '36', 'name' => 'Zapewnienie noclegu i wyżywienia dla rodzin Uczestników przebywających w ośrodku w trybie stacjonarnym', 'module' => 6, 'type' => 1, 'amount_usage' => '90', 'unit' => 11, 'amount_takes' => '', 'is_required' => 0, 'not_applicable' => 0, 'status' => 1],
            ['id' => 39, 'number' => '37', 'name' => 'Opieka nad dziećmi do lat 7 (noclegi, żłobek/przedszkole, dojazdy, wyżywienie) – założono udział 3 dzieci przez 9 miesięcy', 'module' => 6, 'type' => 1, 'amount_usage' => '', 'unit' => 10, 'amount_takes' => '', 'is_required' => 0, 'not_applicable' => 0, 'status' => 1],
            ['id' => 40, 'number' => '38', 'name' => 'Opieka nad dziećmi od lat 7 (noclegi, dojazdy, wyżywienie) – założono udział 2 dzieci przez 9 miesięcy', 'module' => 6, 'type' => 1, 'amount_usage' => '', 'unit' => 10, 'amount_takes' => '', 'is_required' => 0, 'not_applicable' => 0, 'status' => 1],
            ['id' => 41, 'number' => '39a', 'name' => 'Zarządzanie usługą rehabilitacji kompleksowej i monitoring przebiegu wsparcia', 'module' => 7, 'type' => 1, 'amount_usage' => '', 'unit' => 5, 'amount_takes' => '', 'is_required' => 0, 'not_applicable' => 0, 'status' => 1],
            ['id' => 42, 'number' => '39b', 'name' => 'Zarządzanie usługą rehabilitacji kompleksowej i monitoring przebiegu wsparcia', 'module' => 7, 'type' => 1, 'amount_usage' => '', 'unit' => 5, 'amount_takes' => '', 'is_required' => 0, 'not_applicable' => 0, 'status' => 1],
            ['id' => 43, 'number' => '39c', 'name' => 'Zarządzanie usługą rehabilitacji kompleksowej i monitoring przebiegu wsparcia', 'module' => 7, 'type' => 1, 'amount_usage' => '', 'unit' => 5, 'amount_takes' => '', 'is_required' => 0, 'not_applicable' => 0, 'status' => 1],
            ['id' => 44, 'number' => '40a', 'name' => 'Środki zabezpieczające dla Uczestnika - pakiet startowy na 3 miesiące', 'module' => 7, 'type' => 1, 'amount_usage' => '40', 'unit' => 7, 'amount_takes' => '', 'is_required' => 0, 'not_applicable' => 0, 'status' => 1],
            ['id' => 45, 'number' => '40b', 'name' => 'Dodatkowe rękawiczki dla osób poruszających się na wózku - 5 par dziennie', 'module' => 7, 'type' => 1, 'amount_usage' => '4', 'unit' => 10, 'amount_takes' => '', 'is_required' => 0, 'not_applicable' => 0, 'status' => 1],
            ['id' => 46, 'number' => '40c', 'name' => 'Zabezpieczenie pomieszczeń oraz personelu ORK - środki do dezynfekcji rąk i powierzchni, ochrona personelu', 'module' => 7, 'type' => 1, 'amount_usage' => '', 'unit' => 10, 'amount_takes' => '', 'is_required' => 0, 'not_applicable' => 0, 'status' => 1],
            ['id' => 47, 'number' => '40d', 'name' => 'Zakup pakietu środków do dezynfekcji i  ochrony osobistej przy podejrzeniu zakażenia Uczestnika projektu w ORK - zestaw dla 5 osób izolowanych', 'module' => 7, 'type' => 1, 'amount_usage' => '', 'unit' => 12, 'amount_takes' => '', 'is_required' => 0, 'not_applicable' => 0, 'status' => 1],
            ['id' => 48, 'number' => '41a', 'name' => 'Środki zabezpieczające dla Uczestnika; Maseczka ochronna medyczna 4 szt. dzień pobytu ORK /lub 1 szt. FFP2', 'module' => 7, 'type' => 1, 'amount_usage' => '30', 'unit' => 10, 'amount_takes' => '', 'is_required' => 0, 'not_applicable' => 0, 'status' => 1],
            ['id' => 49, 'number' => '41b', 'name' => 'Rękawiczki jednorazowe - na terapię manualną/zajęciową - 1 para na zajęcia/Uczestnika', 'module' => 7, 'type' => 1, 'amount_usage' => '30', 'unit' => 13, 'amount_takes' => '', 'is_required' => 0, 'not_applicable' => 0, 'status' => 1],
            ['id' => 50, 'number' => '41c', 'name' => 'Dodatkowe rękawiczki dla osób poruszających się na wózku - 5 par dziennie', 'module' => 7, 'type' => 1, 'amount_usage' => '4', 'unit' => 14, 'amount_takes' => '', 'is_required' => 0, 'not_applicable' => 0, 'status' => 1],
            ['id' => 51, 'number' => '41d', 'name' => 'Zabezpieczenie pomieszczeń oraz personelu ORK - środki do dezynfekcji rąk i powierzchni, ochrona personelu', 'module' => 7, 'type' => 1, 'amount_usage' => '', 'unit' => 5, 'amount_takes' => '', 'is_required' => 0, 'not_applicable' => 0, 'status' => 1],
            ['id' => 52, 'number' => '41e', 'name' => 'Zakup pakietu środków do dezynfekcji i ochrony osobistej przy podejrzeniu zakażenia Uczestnika projektu w ORK - zestaw dla 5 osób izolowanych', 'module' => 7, 'type' => 1, 'amount_usage' => '', 'unit' => 12, 'amount_takes' => '', 'is_required' => 0, 'not_applicable' => 0, 'status' => 1],
        ];
        foreach($items as $item)
        {
            \App\Models\ServiceList::create($item);
        }
    }
}
