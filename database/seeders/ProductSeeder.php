<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        DB::table('products')->truncate();

        DB::table('products')->insert([
            [
                'reference' => 'PH001', 
                'name_fr' => 'Ravintsara (feuilles)',
                'name_en' => 'Ravintsara (Leaves)',
                'name_latin' => 'Cinnamomum camphora',
                'description_fr' => "Extraite des feuilles du Cinnamomum camphora, cette huile est principalement utilisée pour le soutien respiratoire et immunitaire grâce à ses puissantes propriétés antivirales. Elle est généralement disponible sous forme liquide et dégage un parfum frais et camphré.",
                'description_en' => "Extracted from the leaves of Cinnamomum camphora, this oil is mainly used for respiratory and immune support due to its powerful antiviral properties. It is generally available as a liquid and has a fresh, camphor-like scent.",
                'category_id' => 1,
                'sub_category_id' => 1,
                'image_path' => './assets/img/products/PH001.png',
            ],
            [
                'reference' => 'PH0029',
                'name_fr' => 'Poivre noir',
                'name_en' => 'Black Pepper',
                'name_latin' => 'Piper nigrum',
                'description_fr' => "Extraite du poivre noir cultivé à Madagascar, l'huile essentielle de Piper nigrum est réputée pour son arôme chaud, épicé et légèrement boisé. Riche en composés actifs, elle est appréciée en aromathérapie pour ses propriétés stimulantes et réchauffantes. Elle est également utilisée dans les cosmétiques, les huiles de massage et les formules bien-être pour favoriser la circulation et soulager les tensions musculaires.",
                'description_en' => "Extracted from black pepper cultivated in Madagascar, Piper nigrum essential oil is known for its warm, spicy, and slightly woody aroma. Rich in active compounds, it is valued in aromatherapy for its stimulating and warming properties. It is also used in cosmetics, massage oils, and wellness formulas to promote circulation and relieve muscle tension.",
                'category_id' => 1, 
                'sub_category_id' => 3,  
                'image_path' => './assets/img/products/PH0029.png',
            ],            
            [
                'reference' => 'PH002', 
                'name_fr' => 'Géranium',
                'name_en' => 'Geranium',
                'name_latin' => 'Pelargonium graveolens',
                'description_fr' => "Également connue sous le nom d'huile essentielle de géranium rosat, elle dégage un arôme doux, floral et légèrement mentholé. Largement utilisée en parfumerie, en soins de la peau et en aromathérapie, elle est appréciée pour ses propriétés équilibrantes, calmantes et apaisantes. Son parfum naturel en fait un ingrédient populaire dans les cosmétiques et les produits de bien-être.",
                'description_en' => "Also known as rose geranium essential oil, it has a sweet, floral, and slightly minty aroma. Widely used in perfumery, skincare, and aromatherapy, it is valued for its balancing, calming, and soothing properties. Its natural fragrance makes it a popular ingredient in cosmetics and wellness products.",
                'category_id' => 1,  // Huiles essentielles
                'sub_category_id' => 3,  // Tonifiant (car propriétés équilibrantes et calmantes)
                'image_path' => './assets/img/products/PH002.png',
            ],
            [
                'reference' => 'PE002', 
                'name_fr' => 'Extrait de Vanille',
                'name_en' => 'Vanilla Extract',
                'name_latin' => 'Vanilla planifolia',
                'description_fr' => "Il est réputé pour son arôme riche et crémeux, aux notes florales et sucrées profondes. Issu de gousses de vanille pollinisées à la main et soigneusement affinées, cet extrait est très prisé en gastronomie, en parfumerie et en cosmétiques naturels. Sa complexité et son authenticité en font un ingrédient de choix pour sublimer desserts, boissons et formules haut de gamme.",
                'description_en' => "It is renowned for its rich and creamy aroma with deep floral and sweet notes. Derived from hand-pollinated and carefully cured vanilla pods, this extract is highly prized in gastronomy, perfumery, and natural cosmetics. Its complexity and authenticity make it a choice ingredient to enhance desserts, beverages, and premium formulations.",
                'category_id' => 2,  // Épices (extrait de vanille)
                'sub_category_id' => 5,  // Culinaire
                'image_path' => './assets/img/products/PE002.png',
            ],
            [
                'reference' => 'PH003', 
                'name_fr' => 'Rambiazina vavy',
                'name_en' => 'Helichrysum (female)',
                'name_latin' => 'Helichrysum gymnocephalum',
                'description_fr' => "Extraite des feuilles et des fleurs d'Helichrysum gymnocephalum, cette huile est très appréciée pour ses propriétés réparatrices, notamment en soins de la peau. Elle atténue les cicatrices, les vergetures et les inflammations, grâce à son puissant arôme herbacé sous forme liquide.",
                'description_en' => "Extracted from the leaves and flowers of Helichrysum gymnocephalum, this oil is highly valued for its restorative properties, especially in skin care. It reduces scars, stretch marks, and inflammations, with a strong herbaceous aroma in liquid form.",
                'category_id' => 1,  // Huiles essentielles
                'sub_category_id' => 3,  // Tonifiant (réparateur / soin peau)
                'image_path' => './assets/img/products/PH003.png',
            ],
            [
                'reference' => 'PH004', 
                'name_fr' => 'Rambiazina lahy',
                'name_en' => 'Helichrysum bracteiferum (male)',
                'name_latin' => 'Helichrysum bractéiferum',
                'description_fr' => "Appréciée pour son parfum terreux et herbacé, aux subtiles notes épicées, elle est réputée pour ses puissantes propriétés anti-inflammatoires et régénératrices cutanées. Elle est largement utilisée en soins naturels, en aromathérapie et en médecine traditionnelle. Sa rareté et ses vertus thérapeutiques en font une plante très recherchée.",
                'description_en' => "Appreciated for its earthy and herbaceous scent with subtle spicy notes, it is known for its powerful anti-inflammatory and skin-regenerating properties. Widely used in natural care, aromatherapy, and traditional medicine, its rarity and therapeutic virtues make it a highly sought-after plant.",
                'category_id' => 1,  // Huiles essentielles
                'sub_category_id' => 3,  // Tonifiant (anti-inflammatoire et régénérateur)
                'image_path' => './assets/img/products/PH004.png',
            ],
            [
                'reference' => 'PH005', 
                'name_fr' => 'Tagète',
                'name_en' => 'Tagetes',
                'name_latin' => 'Tagete minuta',
                'description_fr' => "Son arôme puissant, herbacé et légèrement citronné est reconnu pour ses propriétés antifongiques et insectifuges. Il est utilisé en lutte antiparasitaire naturelle, en parfumerie et en médecine traditionnelle. Son parfum distinctif et ses composés bioactifs en font un ingrédient précieux pour les applications cosmétiques et agricoles.",
                'description_en' => "Its strong, herbaceous and slightly lemony aroma is known for its antifungal and insect-repellent properties. It is used in natural pest control, perfumery, and traditional medicine. Its distinctive scent and bioactive compounds make it a valuable ingredient in cosmetic and agricultural applications.",
                'category_id' => 1,  // Huiles essentielles
                'sub_category_id' => 3,  // Tonifiant (usage agricole et thérapeutique)
                'image_path' => './assets/img/products/PH005.png',
            ],
            [
                'reference' => 'PH006', 
                'name_fr' => 'Girofle (feuilles)',
                'name_en' => 'Clove (leaves)',
                'name_latin' => 'Eugenia caryophyllata',
                'description_fr' => "Issue des feuilles du giroflier, cette huile conserve les puissantes propriétés aromatiques et analgésiques des bourgeons de girofle, mais avec une note plus fraîche et boisée. Elle est principalement utilisée pour les soins dentaires et le soulagement de la douleur, souvent sous forme liquide.",
                'description_en' => "Derived from clove tree leaves, this oil retains the strong aromatic and analgesic properties of clove buds, but with a fresher and woodier note. It is mainly used for dental care and pain relief, usually in liquid form.",
                'category_id' => 1,  // Huiles essentielles
                'sub_category_id' => 3,  // Tonifiant (usage analgésique / soin)
                'image_path' => './assets/img/products/PH006.png',
            ],
            [
                'reference' => 'PH007',
                'name_fr' => 'Girofle (clou)',
                'name_en' => 'Clove (bud)',
                'name_latin' => 'Eugenia caryophyllata',
                'description_fr' => "Plongez dans la chaleur enveloppante de l'huile essentielle de clou de girofle, extraite par distillation à la vapeur d'eau de boutons floraux séchés. Son parfum chaud, épicé, boisé et délicatement fruité évoque épices lointaines et traditions ancestrales.",
                'description_en' => "Immerse yourself in the warm embrace of clove essential oil, steam-distilled from dried flower buds. Its warm, spicy, woody, and subtly fruity aroma evokes distant spices and ancestral traditions.",
                'category_id' => 1,  // Huiles essentielles
                'sub_category_id' => 3,  // Tonifiant (usage énergisant, médicinal)
                'image_path' => './assets/img/products/PH007.png',
            ],
            [
                'reference' => 'PH008',
                'name_fr' => 'Girofle (griffe)',
                'name_en' => 'Clove (stem)',
                'name_latin' => 'Eugenia caryophyllata',
                'description_fr' => "Laissez-vous emporter par la puissance aromatique de l'huile essentielle d'Eugenia caryophyllata, extraite par distillation à la vapeur d'eau des boutons floraux séchés. Son parfum chaud, épicé, subtilement fruité et légèrement boisé éveille les sens dès les premières notes.",
                'description_en' => "Let yourself be carried away by the aromatic power of Eugenia caryophyllata essential oil, steam-distilled from dried floral buds. Its warm, spicy, subtly fruity and slightly woody scent awakens the senses from the very first notes.",
                'category_id' => 1,  // Huiles essentielles
                'sub_category_id' => 3,  // Tonifiant (stimulant et aromatique)
                'image_path' => './assets/img/products/PH008.png',
            ],
            [
                'reference' => 'PH009',
                'name_fr' => 'Cannelle (feuilles)',
                'name_en' => 'Cinnamon (leaves)',
                'name_latin' => 'Cinnamomum zeylanicum',
                'description_fr' => "Découvrez la facette méconnue de la cannelle avec l'huile essentielle de feuilles de cannelle. Distillée à partir des feuilles de l'arbre, elle révèle un parfum plus doux et herbacé, rehaussé de nuances épicées et légèrement médicinales.",
                'description_en' => "Discover the lesser-known side of cinnamon with leaf essential oil. Distilled from the tree’s leaves, it reveals a milder, herbal aroma with spicy and slightly medicinal undertones.",
                'category_id' => 1,  // Huiles essentielles
                'sub_category_id' => 2,  // Digestif (souvent utilisée pour ce type d'effet)
                'image_path' => './assets/img/products/PH009.png',
            ],
            [
                'reference' => 'PH0010',
                'name_fr' => 'Gingembre (frais)',
                'name_en' => 'Fresh Ginger',
                'name_latin' => 'Zingiber officinale',
                'description_fr' => "Laissez-vous emporter par la chaleur aromatique de l'huile essentielle de gingembre, distillée à la vapeur d'eau à partir de ses rhizomes. Son parfum épicé, chaud et délicatement citronné éveille les sens et invite au dynamisme.",
                'description_en' => "Let yourself be carried away by the warm aroma of ginger essential oil, steam-distilled from its rhizomes. Its spicy, warm and delicately lemony scent awakens the senses and invites vitality.",
                'category_id' => 1,  // Huiles essentielles
                'sub_category_id' => 2,  // Digestif
                'image_path' => './assets/img/products/PH0010.png',
            ],
            [
                'reference' => 'PH0011',
                'name_fr' => 'Niaouli',
                'name_en' => 'Niaouli',
                'name_latin' => 'Melaleuca quinquenervia',
                'description_fr' => "Connue pour son arôme frais, camphré et légèrement sucré, elle est réputée pour ses propriétés antiseptiques, respiratoires et immunostimulantes. Elle est largement utilisée en aromathérapie, en soins de la peau et en médecine naturelle. Ses propriétés purifiantes en font un ingrédient puissant dans les formules thérapeutiques et de bien-être.",
                'description_en' => "Known for its fresh, camphoraceous and slightly sweet aroma, niaouli is renowned for its antiseptic, respiratory, and immune-stimulating properties. Widely used in aromatherapy, skincare, and natural medicine, its purifying qualities make it a powerful ingredient in therapeutic and wellness formulas.",
                'category_id' => 1,  // Huiles essentielles
                'sub_category_id' => 1,  // Respiratoire
                'image_path' => './assets/img/products/PH0011.png',
            ],
            [
                'reference' => 'PH0012',
                'name_fr' => 'Katrafay',
                'name_en' => 'Katrafay',
                'name_latin' => 'Cedrelopsis grevei',
                'description_fr' => "Son arôme chaud, boisé et légèrement poivré est reconnu en médecine traditionnelle malgache pour ses propriétés anti-inflammatoires, analgésiques et tonifiantes. Le katrafay est largement utilisé dans les soins de bien-être, notamment comme huile de massage et comme soin revitalisant.",
                'description_en' => "Its warm, woody, and slightly peppery aroma is recognized in traditional Malagasy medicine for its anti-inflammatory, analgesic, and tonifying properties. Katrafay is widely used in wellness treatments, notably as a massage oil and revitalizing care.",
                'category_id' => 1,  // Huiles essentielles
                'sub_category_id' => 3,  // Tonifiant
                'image_path' => './assets/img/products/PH0012.png',
            ],
            [
                'reference' => 'PH0013',
                'name_fr' => 'Citriodora',
                'name_en' => 'Citriodora',
                'name_latin' => 'Eucalyptus citriodora',
                'description_fr' => "Dérivée des feuilles de l'eucalyptus citriodora, cette huile est réputée pour son parfum rafraîchissant et ses propriétés insectifuges. Utilisée dans les produits de soins personnels et en aromathérapie, elle est généralement disponible sous forme liquide.",
                'description_en' => "Derived from the leaves of eucalyptus citriodora, this oil is known for its refreshing scent and insect-repellent properties. Used in personal care products and aromatherapy, it is generally available in liquid form.",
                'category_id' => 1,  // Huiles essentielles
                'sub_category_id' => 1,  // Respiratoire
                'image_path' => './assets/img/products/PH0013.png',
            ],
            [
                'reference' => 'PH0014',
                'name_fr' => 'Thym',
                'name_en' => 'Thyme',
                'name_latin' => 'Thymus vulgaris',
                'description_fr' => "Plongez dans l'arôme intense et caractéristique du thymol de Thymus vulgaris CT, une huile essentielle extraite par distillation à la vapeur d'eau des feuilles et des sommités fleuries de la plante. Riche en thymol, son principal chémotype.",
                'description_en' => "Immerse yourself in the intense and characteristic aroma of thymol from Thymus vulgaris CT, an essential oil extracted by steam distillation of the plant's leaves and flowering tops. Rich in thymol, its main chemotype.",
                'category_id' => 1,  // Huiles essentielles
                'sub_category_id' => 1,  // Respiratoire (adapté pour le thym)
                'image_path' => './assets/img/products/PH0014.png',
            ],
            [
                'reference' => 'PH0015',
                'name_fr' => 'Citronnelle',
                'name_en' => 'Lemongrass',
                'name_latin' => 'Cymbopogon citratus',
                'description_fr' => "Laissez-vous revitaliser par l'huile essentielle de Cymbopogon citratus, obtenue par distillation à la vapeur d'eau à partir de feuilles finement coupées et partiellement séchées. Son arôme vif, frais et puissamment citronné en fait une véritable bouffée d'air frais, idéale pour éveiller les sens.",
                'description_en' => "Revitalize yourself with the essential oil of Cymbopogon citratus, obtained by steam distillation from finely cut and partially dried leaves. Its sharp, fresh, and powerfully lemony aroma makes it a true breath of fresh air, perfect for awakening the senses.",
                'category_id' => 1,  // Huiles essentielles
                'sub_category_id' => 1,  // Respiratoire (adapté à ses bienfaits)
                'image_path' => './assets/img/products/PH0015.png',
            ],
            [
                'reference' => 'PH0016',
                'name_fr' => 'Citron',
                'name_en' => 'Lemon',
                'name_latin' => 'Citrus limon',
                'description_fr' => "Laissez-vous envelopper par l'éclat naturel de l'huile essentielle de Citron Vert, obtenue par pression à froid de zestes frais. Son parfum vif, pétillant et intensément frais insuffle instantanément légèreté et dynamisme.",
                'description_en' => "Let yourself be wrapped by the natural brightness of Lemon essential oil, obtained by cold pressing fresh peels. Its sharp, sparkling, and intensely fresh scent instantly brings lightness and dynamism.",
                'category_id' => 1,  // Huiles essentielles
                'sub_category_id' => 1,  // Respiratoire (adapté à ses vertus)
                'image_path' => './assets/img/products/PH0016.png',
            ],
            [
                'reference' => 'PH0017',
                'name_fr' => 'Basilic',
                'name_en' => 'Basil',
                'name_latin' => 'Ocimum basilicum',
                'description_fr' => "Plongez dans l’arôme herbacé, frais et subtilement épicé de l’huile essentielle de Basilic (Ocimum basilicum), distillée à la vapeur à partir de ses feuilles et sommités fleuries. Son parfum raffiné réveille les sens tout en apportant une agréable sensation de légèreté.",
                'description_en' => "Dive into the herbal, fresh, and subtly spicy aroma of Basil essential oil (Ocimum basilicum), steam-distilled from its leaves and flowering tops. Its refined scent awakens the senses while bringing a pleasant sensation of lightness.",
                'category_id' => 1,  // Huiles essentielles
                'sub_category_id' => 1,  // Respiratoire (adapté à ses vertus)
                'image_path' => './assets/img/products/PH0017.png',
            ],
            [
                'reference' => 'PH0018',
                'name_fr' => 'Saro ou Mandravasarotra',
                'name_en' => 'Saro or Mandravasarotra',
                'name_latin' => 'Cinnamosma fragrans',
                'description_fr' => "Extraite des feuilles de Cinnamosma fragrans, cette huile est reconnue pour ses effets antiviraux et immunostimulants. Utilisée dans les soins respiratoires et les produits de soutien immunitaire, elle est disponible sous forme liquide au parfum épicé et végétal.",
                'description_en' => "Extracted from the leaves of Cinnamosma fragrans, this oil is known for its antiviral and immune-stimulating effects. Used in respiratory care and immune support products, it is available as a liquid with a spicy and vegetal scent.",
                'category_id' => 1,  // Huiles essentielles
                'sub_category_id' => 1,  // Respiratoire (adapté à ses vertus)
                'image_path' => './assets/img/products/PH0018.png',
            ],
            [
                'reference' => 'PH0019',
                'name_fr' => 'Vetiver',
                'name_en' => 'Vetiver',
                'name_latin' => 'Vetiveria zizanoides',
                'description_fr' => "Plongez dans la richesse aromatique du vetiver, une huile essentielle soigneusement extraite par distillation à la vapeur d'eau de ses racines puissantes. Son parfum intense, terreux et boisé, invite à la sérénité, à la reconnexion avec soi-même et à la terre.",
                'description_en' => "Immerse yourself in the aromatic richness of vetiver, an essential oil carefully extracted by steam distillation from its strong roots. Its intense, earthy, and woody scent invites serenity, self-connection, and grounding.",
                'category_id' => 1,  // Huiles essentielles
                'sub_category_id' => 3,  // Tonifiant (adapté pour ses vertus calmantes et ancrantes)
                'image_path' => './assets/img/products/PH0019.png',
            ],
            [
                'reference' => 'PH0020',
                'name_fr' => 'Eucalyptus globulus',
                'name_en' => 'Eucalyptus globulus',
                'name_latin' => 'Eucalyptus globulus',
                'description_fr' => "Extraite des feuilles de l'eucalyptus globulus, cette huile est réputée pour son arôme puissant et piquant et est couramment utilisée pour traiter les infections respiratoires. Disponible sous forme liquide, elle est un ingrédient de base de préparations médicinales comme les sirops et baumes contre la toux.",
                'description_en' => "Extracted from the leaves of Eucalyptus globulus, this oil is known for its strong and sharp aroma and is commonly used to treat respiratory infections. Available in liquid form, it is a key ingredient in medicinal preparations such as cough syrups and balms.",
                'category_id' => 1,  // Huiles essentielles
                'sub_category_id' => 1,  // Respiratoire
                'image_path' => './assets/img/products/PH0020.png',
            ],
            [
                'reference' => 'PH0021',
                'name_fr' => 'Longoza Aframomum angustifolium',
                'name_en' => 'Longoza Aframomum angustifolium',
                'name_latin' => 'Aframomum angustifolium',
                'description_fr' => "Connue pour son arôme frais, épicé et légèrement sucré, elle est traditionnellement utilisée pour ses propriétés revitalisantes et régénératrices. Elle est de plus en plus appréciée en cosmétique pour ses effets raffermissants et anti-âge. Son parfum exotique en fait également un ingrédient précieux en parfumerie et dans les produits de bien-être.",
                'description_en' => "Known for its fresh, spicy, and slightly sweet aroma, it is traditionally used for its revitalizing and regenerating properties. Increasingly appreciated in cosmetics for its firming and anti-aging effects. Its exotic scent also makes it a valuable ingredient in perfumery and wellness products.",
                'category_id' => 1,  // Huiles essentielles
                'sub_category_id' => 3,  // Tonifiant (revitalisant)
                'image_path' => './assets/img/products/PH0021.png',
            ],
            [
                'reference' => 'PH0022',
                'name_fr' => 'Orange',
                'name_en' => 'Orange',
                'name_latin' => 'Citrus sinensis',
                'description_fr' => "Laissez-vous emporter par la fraîcheur pétillante de l'huile essentielle d'orange Citrus sinensis, obtenue par pression à froid de l'écorce du fruit mûr. Son parfum joyeux, fruité et lumineux diffuse instantanément une sensation de bien-être et de bonne humeur.",
                'description_en' => "Let yourself be carried away by the sparkling freshness of orange essential oil Citrus sinensis, obtained by cold pressing of the ripe fruit peel. Its joyful, fruity, and bright scent instantly spreads a feeling of well-being and good mood.",
                'category_id' => 1,  // Huiles essentielles
                'sub_category_id' => 3,  // Tonifiant (effet vivifiant)
                'image_path' => './assets/img/products/PH0022.png',
            ],
            [
                'reference' => 'PH0023',
                'name_fr' => 'Ylang 1',
                'name_en' => 'Ylang 1',
                'name_latin' => 'Cananga odorata',
                'description_fr' => "Extraite des fleurs du Cananga odorata, cette huile est réputée pour son arôme riche et floral. Très appréciée en parfumerie, elle est également utilisée pour ses vertus apaisantes et aphrodisiaques. Disponible sous forme liquide, elle dégage un parfum doux et exotique.",
                'description_en' => "Extracted from the flowers of Cananga odorata, this oil is known for its rich and floral aroma. Highly appreciated in perfumery, it is also used for its soothing and aphrodisiac properties. Available in liquid form, it releases a soft and exotic fragrance.",
                'category_id' => 1,
                'sub_category_id' => 1,
                'image_path' => './assets/img/products/PH0023.png',
            ],
            [
                'reference' => 'PH0024',
                'name_fr' => 'Ylang 2',
                'name_en' => 'Ylang 2',
                'name_latin' => 'Cananga odorata',
                'description_fr' => "Extraite des fleurs du Cananga odorata, cette huile est réputée pour son arôme riche et floral. Très appréciée en parfumerie, elle est également utilisée pour ses vertus apaisantes et aphrodisiaques. Disponible sous forme liquide, elle dégage un parfum doux et exotique.",
                'description_en' => "Extracted from the flowers of Cananga odorata, this oil is known for its rich and floral aroma. Highly appreciated in perfumery, it is also used for its soothing and aphrodisiac properties. Available in liquid form, it releases a soft and exotic fragrance.",
                'category_id' => 1,
                'sub_category_id' => 1,
                'image_path' => './assets/img/products/PH0024.png',
            ],
            [
                'reference' => 'PH0025',
                'name_fr' => 'Ylang 3',
                'name_en' => 'Ylang 3',
                'name_latin' => 'Cananga odorata',
                'description_fr' => "Extraite des fleurs du Cananga odorata, cette huile est réputée pour son arôme riche et floral. Très appréciée en parfumerie, elle est également utilisée pour ses vertus apaisantes et aphrodisiaques. Disponible sous forme liquide, elle dégage un parfum doux et exotique.",
                'description_en' => "Extracted from the flowers of Cananga odorata, this oil is known for its rich and floral aroma. Highly appreciated in perfumery, it is also used for its soothing and aphrodisiac properties. Available in liquid form, it releases a soft and exotic fragrance.",
                'category_id' => 1,
                'sub_category_id' => 1,
                'image_path' => './assets/img/products/PH0025.png',
            ],
            [
                'reference' => 'PH0026',
                'name_fr' => "Eucalyptus radiata",
                'name_en' => "Eucalyptus radiata",
                'name_latin' => "Eucalyptus radiata",
                'description_fr' => "Issue des feuilles de l'eucalyptus radiata, cette huile est plus douce et plus délicate que les autres huiles d'eucalyptus, ce qui la rend idéale pour la santé respiratoire et l'aromathérapie. Son parfum frais et pur est disponible sous forme liquide.",
                'description_en' => "Derived from the leaves of eucalyptus radiata, this oil is softer and more delicate than other eucalyptus oils, making it ideal for respiratory health and aromatherapy. Its fresh and pure scent is available in liquid form.",
                'category_id' => 1,
                'sub_category_id' => 1,  
                'image_path' => './assets/img/products/PH0026.png',
            ],
            [
                'reference' => 'PH0030',
                'name_fr' => "Palmarosa",
                'name_en' => "Palmarosa",
                'name_latin' => "Cymbopogon martinii",
                'description_fr' => "Plongez dans la douceur florale de l'huile essentielle de Palmarosa Cymbopogon martinii, obtenue par distillation à la vapeur d'eau d'herbes fraîches ou partiellement séchées. Son parfum subtil, à la fois floral, herbacé et délicatement exotique, rappelle la douceur de la rose tout en offrant une note unique.",
                'description_en' => "Immerse yourself in the floral softness of Palmarosa essential oil, obtained by steam distillation of fresh or partially dried herbs. Its subtle scent, both floral, herbal, and delicately exotic, recalls the sweetness of rose while offering a unique note.",
                'category_id' => 1,
                'sub_category_id' => 1,
                'image_path' => './assets/img/products/PH0030.png',
            ],
            [
                'reference' => 'PH0027',
                'name_fr' => "Dingadingana",
                'name_en' => "Dingadingana",
                'name_latin' => "Psiadia altissima",
                'description_fr' => "Extraite des feuilles de la plante Psidia altissima, cette huile peu connue est réputée pour ses effets anti-inflammatoires et analgésiques. Utilisée en médecine traditionnelle, elle est de plus en plus présente sur les marchés internationaux des produits de santé naturels, avec son parfum boisé et herbacé sous forme liquide.",
                'description_en' => "Extracted from the leaves of the Psiadia altissima plant, this little-known oil is reputed for its anti-inflammatory and analgesic effects. Used in traditional medicine, it is increasingly present in international natural health product markets, with its woody and herbal scent in liquid form.",
                'category_id' => 1,
                'sub_category_id' => 1,  
                'image_path' => './assets/img/products/PH0027.png',
            ],
            [
                'reference' => 'PH0028',
                'name_fr' => "Cyprès",
                'name_en' => "Cypress",
                'name_latin' => "Cupressus sempervirens",
                'description_fr' => "Dérivée des aiguilles et des brindilles du cyprès, cette huile est reconnue pour son parfum frais et pur et ses propriétés apaisantes. Elle est utilisée dans les huiles de massage, les soins spa et pour le soutien respiratoire, généralement sous forme liquide.",
                'description_en' => "Derived from the needles and twigs of cypress, this oil is known for its fresh and pure scent and soothing properties. It is used in massage oils, spa treatments, and for respiratory support, generally in liquid form.",
                'category_id' => 1,
                'sub_category_id' => 1,
                'image_path' => './assets/img/products/PH0028.png',
            ],
              
        ]);
    }
}
