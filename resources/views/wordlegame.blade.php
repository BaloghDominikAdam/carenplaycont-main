@extends('layout')
@section('content')
    <main class="main-block">
        <div class="section3 container">

            <div id="modal2" class="modal2">
                <div class="modal2-content gamemodal ">
                    <h2>Wordle játék teljesítve!</h2>
                    <h5 id="modal-points">50 pontot szereztél ezzel a játékkal!</h5>
                    <div class="d-flex justify-content-between align-items-center">
                        <form action="/wordlegame" method="post">
                            @csrf
                            <input type="hidden" name="points" id="hidden-points" value="0">
                            <input type="hidden" name="game_name" value="Worlde Játék">
                            <button type="submit" class="btn btn-info" id="save-btn">Eredmény mentése</button>
                        </form>
                        <button class="btn btn-info" id="restart-btn">Új játék</button>
                    </div>

                </div>
            </div>


            <div class="wordle-container">
                <div class="wordlegame" id="game"></div>
            </div>






        </div>
        </div>

        <script>
            const read =
                "abbanabbizablakabrakadhataddigadomaadottaduttafrikaggatagoraagyagagyalagyaragyonahajtahhozahogyahovaajjajajkaiajnyeakkorakonaaktinaktusalakialantalanyalarmalattalbumalfajalhasalhataliasalibialjasaljazalkaralkatalkilalkotalmozalnemaltatalteraludtalulialvadalzatamcsiamelyamiceamilyaminoamintamireamishamodaamorfamottamperanginangolanionankerannakannyiantikantulanyaganyaianyusaortaapacsapjukapuciapukaarabsaradiaranyaraszarculargonaromaarrakaszalaszataszikatollatomiattakatyaiatyusaudioauditaugurauxinavagyavultavvalazeriaznapazzalbabosbaconbacsabadarbajaibajbabajolbajorbajosbalekbalgabalhabalinbalogbalosbaltabaltibalulbalutbambabambibandabangabankabankibantubanyabaritbarkabarmibarnabarombasszbaszibaszkbatikbatkabatulbatyubazsabedobbedugbefalbefedbefenbefogbefonbefutbehozbeingbeintbejutbekapbekenbelepbelesbelgabelopbokorbemosbennebentibeoltberakberekberkebernibesszbestebetegbetlibetolbetonbetudbeverbevetbevonbibisbicajbicegbiluxbirkabirokbitesbizsublamablattblikkblokkbluesbocfabocsibodagbodonbodribodzabogasbogosbogozboksabokszbolhabolsiboltibolyhbombabomolbonnibontabordaborosborozborulbotorbotosbotozbrahibrandbreakbrillbronzbrossbubusbuckabudaibufetbuflibufogbuggybugyibukikbuksibuktabuktibullabumlibundaburkaburokbutikbutulbutusbuzogcafatcafkacafracangacantocefetcefrecellacenticepelcerkacetlichilichipscibakciciccicizcickacicuscidricifracigizcihercikizciklocimetcimpacinezcinkecipelcirkacirokcivilcoloscontocsalicsaltcsapacsatacsecscsegecsekkcsendcsengcseppcserecseszcsibacsibecsigacsikkcsilicsinicsinncsipacsiracsittcsodacsokicsonkcsontcsozecsudacsuhacsuhucsukacsumacsupacsuricsutacuclicudarcujkacukorcurrycvikidacoldacosdadogdadusdafkedagaddajkadajnadaklidaliadaloldalosdamildancedancsdankadanoldarabdartsdarusdauerdavajdebildecisdeklidekordelejdeleldeltadendiderbidercederesdeucedevladevondobradigitdilisdinerdingidinkadiszkdivatdivizdobajdobogdoboldobosdobozdogmadohogdohosdolgadologdongadonnadonogdonordosztdoyendrappdrilldrukkdudlidudordudvaduettdugigduguldugvaduhajdundidunnadupladuraldurumdurvadutyiduzmadzsemdzsipebbenebfogechteecsetedamieddigedzetegresegybeegyedegyelegyenegyesegyezegyikegykeegyreehejtehhezejnyeejtetekkoreldobeldugelegyelejeelejielejtelemieleveelfedelfogelfutelhalelhatelhozelibeelirteljutelkapelkelelkenellenellepelleselletellikellopelmarelmoseloldeloltelrakelteleltolelvanelverelvetelvezelvonemailemberemeltemideemittengedengemennekennenennyienyecenyheenzimeozinepedaepikaeposzepreserdeieredjereszerikaerjedesengesetiesetteshetesketestveeszeleszereszeseszikeszmeetikaevvelexlexexnejextraezredezrenezresezzelfaarcfabakfaekefafajfagyifajtafajulfakadfakulfalakfalamfalasfalatfalazfalkafapadfaradfaragfarbafarokfarolfasorfateafaterfaultfaunafaxolfazonfecnifedezfejbefejelfejesfejezfejfafektefekvefeladfeledfelelfelesfelezfinakfelnifenolfentiferdefeselfesztficamficcsfiliafinisfinomfintafiolafirkafirmafitetfitosfittyfizetfjordflancflekkflemmflopiflottfluorfodorfogadfoganfogasfogatfogazfogdafogtafogvafurikfokolfokosfokozfonalfonatfordaformaforogforszfortefosikfososfosztfotelfotonfrakkfrancfrankfrigyfrissfritzfrontfuccsfukarfuratfuserfutamfutosfuttafuvargalajgallygamergammaganajgarasgaratgardagatyagaussgazdagazdigazolgazosgebedgebingemmagennygenusgerlegestagesztgibicgiccsgipszgizdaglancgofrigogosgombagopakgrammgrandgriffgrillgrundgruppguelfgugyigulyagumisgumizguppigurulguvatguzlagyalugyaurgyeregyorsgyufagyulahabarhabdahaboghaboshadarhadathadbahadfihadrihaikuhajajhajashajazhajolhajszhaknihaladhalashalefhalmahalomhalvahamarhamishamushanemhangahantahantihapcihapsiharagharapharciharishasadhasalhasashasbahasishasonhasrahatanhatodhatolhatoshavashaverhazaihazughebeghegedhegeshegyihekushellohelyehelyihelythennahenryhenyehepajhermahertzhetedhetelhetenhetesheverheveshidalhidashideghidrahienchihethilushimbahindihinduhintahipishippihirighitelhiteshitethivathjajahobbihokishokizhollaholmiholtahomokhonfihonolhonorhonoshorkahoroghorpahosszhotelhousehuculhuhoghujjahullahumorhurkahurokhuruthuzaghuzalhuzamhuzatiafiaibrikideadidebeidegiideigidejeidekiideleidillifjakifjanifjuligaziigricigyadihajaihletihlikijedtikrekikresiktatildomillanillatillemilletillikilyenilyesimageimimaimittimmunimolainboxindexindokindulindusinertingatingeringesingusinneninputintetintimintriipariipponirakiirdalirigyirodairtatislerismeristeniszapiszikittasittenityegivariivritizgatizgulizmosizmusizzadizzikjachtjajosjakutjampijasszjavakjavasjavuljegecjegeljegesjeleljelenjelesjelezjenkijerkejogarjogosjogsijointjokerjollejottajoulejuharjuicejukkajuntajuppijurtajusztjutatkabakkabarkabilkabinkacagkacajkacatkacorkacsakadarkadetkaholkajakkajlakajolkakaskakilkalapkalitkallakamatkamelkamrakancakandikannakanoskantakanyikaparkapatkapcakaplikaporkaprikaptakapuskaputkarajkarfakaribkarolkaromkaronkaroskaskakasoskasubkaszakasztkavarkazahkazalkebabkebelkeddikefirkehelkeheskekszkelepkeletkelimkelmekeltakeltekenafkencekendekenetkenuskerekkerepkereskeretkergekertikerubkeserketonkeverkezelkezeskezezkhakikhmerkiberkibickibuckicsikidobkidugkiejtkifejkifenkiflikifogkifonkifutkihalkihatkihozkiirtkijutkikapkikelkikenkileskilimkilopkimarkimerkimoskincskininkintikioldkioltkiontkirakkiszekitinkitlikitolkitudkivankiverkivetkivonklafaklakkklikkklottknappkoalakobakkobozkobrakockakocogkocsikoholkokaskokszkolnakolopkombikomorkondakondikonokkontykonyakonzikopekkopikkopjakopogkoprakoraikorcskordakorfakorogkoromkoroskorpakortykosztkotlakotonkotorkottakottykotuskozmakozmokrachkrakkkrallkreolkreppkrimikrokikruppkubikkuglikujonkukackuktakulcskulizkupackupakkupeckuponkurtakuruckutatkutinkutyakuvikkvarckvarkkvartkvaszkvintkvittlatinlabdalaborladiklagzilajbilajhalakatlakiklaklilakollakoslaktalangylankalapajlapkalaposlapozlapullargolaskalatollatorlazaclazullebeglebkelebujleckeledobleejtlefedlefoglefutlegellehatlehellehetlehozleintleirtlejeslejutlekaplekenlelesleletlelkileloplemarlemerlemezlemoslemurlengelennilentileoldleoltlepellepkelepraleptelerakletetletolletudlevanleverleveslevetlevonlibeglibuclicitligetlihegliliklimeslimitlinzilipidlistalisztliterlityilobbilobbylobogloboslogarlohadloholloknilomhalopvalovaglovallovasludaslueszlugaslukadlukaslumenlustalutriluxuslyonimaccsmachomaflamagadmagammagasmagmamagolmagosmagozmajommajormakogmakramalacmalmimalommalusmamutmancsmannamanusmaorimappamaradmaratmarcimarhamarjamarokmarsimarximaslimasnimaszkmatatmatekmaznameccsmedokmedveminapmegadmeggymegunmegyemehetmekegmelegmendemenetmennimennymentamentementimenzameredmerevmerremerszmetszmezeimezesmezonmiattmienkmikormikromillaminekmintamirhamiskamitramivelmixelmixermobilmodemmodormodulmogulmoharmohermohosmokkamondamopedmorajmorogmorvamorzemosatmotelmotormotozmozismozogmucusmuftimuharmulatmultimulyamumusmunkamurcimurismurokmurvamutatmutermutyinaftanagyinaivanandunanuknapamnapjanapolnaposnapranemdenemesnemezneszenevelnevesnevetneveznexusnihilnimfanincsnomennormanoszanubuknudlinullanyakinyekknyelvnyersnyertnyestnylonnyolcnyugiobsitodaadodabeodakiodaleodvasofinaokapiokkalokkeroktatolaszoldaloldatoldozoleinoltatolvadolvasolyanolyasolyhaolyikomlikonklionnanontatoperaordasorgiaorlonoroszorrolorvosorvulostorostyaoszolottanpacalpackapacnipacsipadkapaducpajorpajtapajtipajzspaklipakolpaksipalkapalolpamatpampapamutpancspandapanelpapolpaposparajparkipartepartipasaspasszpatakpatnipauzapaxitpazarpecekpederpedigpeluspengepennapennyperbeperecperegperelperemperesperjepermiperonpertuperuipeselpestipetitpettypiacipianopiarcpicurpihegpihenpilispillapillepilonpincepincspinkapintypipilpiritpirogpirospirulpisilpisispislapisszpiszepiszipitarpitizpitlepitlipitonpixelpizsipizzaplaccplakkplattplazaplexiplumppluszpocakpocokpofonpofozpohospoklapokolpoliopolippolkapompapontypopsiporbaporolporosporozportapostaposztpotompotyaprepapriorproccprofiproliprotiprotopuccspucerpucolpudlipudvapuflipufnipufogpuhulpuklipulyapumpapuncipuncspurimpurinpuskapusziputriqueerrabbirabicrabolracizrackaradarradioradonrafiaragadragosragozragyarajonrajtarakatrandarandirapidraplirasszrebegreccsredutrehabrekedrekegreketremegremekrencerendirepcerepedrepesrepterestiresztretekretusreumarevesrezegrezelrezesrezsiriadtridegrigliriksaripszriskaritkarizsarobajrobogrobotrohadrohamrohanrohogrokkarokonrolnirombaromolromosroncsrondarongyropogrosszrostarotorrovarrovatrubelrubinrudalrudasrudazrumbarumlirumosrutilrutinsajkasajogsalaksandasanszsapkasarkisaroksarussasfasavassebajsebesselmasebezsedreseholselypsemmisenkisenyeseperseregseresserkeserpasertesifonsifresihtasikersiketsimlisimulsincssipegsipkasipogsiratsisaksiskaskalpskartskiccskurcslangslaugslejmsleppsliccslukksmacismafusminksmokksmukksnecisneffsnittsodorsohsesokansokatsomfasonkasorbasorfasorjasorolsoronsorossorozsorrasosemspejzspiccspionsportsprayspuristandstartstaubsteakstercstichstiftstokistukasusogsufnisuhansuhogsumersummasunyisuskasuttysutyisuvadsvarcsvenksvungszabiszaftszakiszaluszapuszaruszarvszebbszegyszejmszemeszentszenvszerbszeriszervszeszszettszexiszextszikeszikhszikiszilaszintszirtsziszszitaszitusziviszlamszmogsznobszobaszociszoliszomjszorbszukaszuszszvittaccstagadtagoltagostagoztajgatakartaksatalajtalaptalmitalontamiltangatantitanultanyatapodtapostarajtarjatarkataroltasaktaslitataitatustatyitavastaxistegeztehertehettejbetejeltejestekerteklatelektelelteleptelextelikteljetelvetemettenortentetepertepsiterehterelteremtereptermatermotestiteszttetemtetettiaratildetiloltilostincstintatipegtiplitiportiszttitoktizedtizentizestoboztojiktokostolattollutolultompatonortoniktonnatopistopogtormatornatoroktoroltoroztortatorzstotemtotyatoxintradetrapptrefftrendtrolitromftropatrucctrupptubustucattudattudortudtatulajtuloktumortunyaturfaturhaturmaturultusoltutajtutultutyityepiuccseudvarugratugrikugyanujgurujjasujujuultraumbraunciauncsiundokundorunokaunottuntatuntiguracsuralgustorutcaiuvulavacakvacogvacokvadasvadonvadulvagonvajasvajazvajdavajhavajmivajonvakarvakervakfavakogvakolvakonvaksivakszvakulvalagvalidvarasvargavariavariovarosvarsavasalvasasvasazvasfavatatvattavedelvedervegyivehetveknivelinvellavemheverdaverdeveremveresveretverteveszivesztvetetvetvevezetviaszvideovidorvidravidulvigadviharvihetvihogvilagvillavillivinilviolavirulviselvisszvitatvitelvitetvitlavitusvizelvizesvizezvizitvlachvodkavogulvolnavoltavonalvonatvonulvuklivulgowebezwengexenonxeroxxilolzablazabolzaboszajogzajoszalaizamatzanzazavarzebrazeneizenitzergezilizzircizizegzlotyzoknizokogzokonzombizrikazsaluzsaruzsenizsepizsibazsoldzsongzsufazsufizsugazsuppzsuvizubogzuhanzuhogzuttyakrilbelezkarmahordakongaledugkutassavaztapadteafagagyiagyasilleghalonaktorfarosfelekfuvathozamhozatkuszalovazmedersajnasajnaaggikaggulajzatbotolbulizcumizdobatdugatelaggestetfaluzfejetfenetfosatguvadhabozhehezizzatkatatkiingkukullapollefejlehallepetlifeglilullopatojtatpadolpalizpapizrezezropattapiztojatuszulhegyeisszalelkemagjamagvanyomarabjatalpaalapiiklatalpinlennetudomnekemtudjateszitennivennitagjatudoknaponfogjanekednekemtettenekikegyettudnitudodvettetudszvelemnapighozzamaguktagokfogoknapotjogokkapniadnakakartkapszhoztajogotfogomvizetjelzikinekilyethozniveledadtaktudomlapotolyatfolytkapjaszerttegyeigazaerejeeinemteretfogszjutnijeleknapokvegyeadunkvinnifogodtudodtudnakezdinekedpicitelemesorsanetenbalralapokviszianyjanevekhisziadjonsokakkedvejeletadjukadtambajomakadtlaponkapoksorokhinnihetetemelielvektestefajoknevedvonjapapokmonddneveddaloknekedfejemszavafutniutalttudjahittemibenfogniamibetervemiketwebesfokoncikkelaprakezetvonnititkakivelurunknevemhalaktejetkinekkorigkezemesneknekemprogivizeknemetesetehagydhetekdalomejtiketetifalrafaltafaszafaszifatokgyanuhavonitalakanoklelakmerekmerteoldjaperlirabotratyisasolszediszelitacsiterektoltatorosvaratvetikvetnikeltiszelecsulalomosvontamulcstolomehetikenedkeneknyakafalomhitedhalatcukrainfrakakismerempaleoboszisarazfalapkiinteszemrinyaledesvigyekezedszurisaraslefosuraimevettsaratutasatorkaraboksasoktelnefonniragotnemekfeletromonokolthavazfedtenetezsikosglettnyesiszeltlesenmosodtavatrabossokalagyatakibesokrarezetsavatsorodbusztiszomlovatnyaltagybakiketnesztszegifejedversesokbapadosmellefonszrajzariszaezretlestejeledbelekmenneloptaseggetereslesnedeletlefonelfonhasatszagakelnikekeclovakeszekhatraragjahajatpadrafejreropistokotlesemleselnyeltnyeliosszapasikmarnilaknasebekfejenezrekraktadelesfentesarkahatbamossavacsifogaimagotlincsraknazsebefedekhalokkenemdaluknapodkezekpasistelkeemeztbajokvasatjograegyekarcosromotpolcafalonnapomtanokteletborratermerakodagutibaingbazsibeedzbeejtbefejbehalbehatbekelbeleibelelbemarbemerbeojtbeoldboyosbabotlepnikihezfutjalatexajkakboxerboxoscicikcikisdidikettekrejtiosontfarkalikasakardsatukivotttolniszeddalmokbakikbilikbocikcukikcumiknetesehessetesssiessdokikducikeprekfalukfiaikfocikagyamagyadhagyjagyaktavakagyazalkusakireesnielevemaludjgumikarcokmisemlufisolivalopoklesiklopszlevekverzelevedlesekfogamhajammagokadjaktokralopnalelemleledtesislesedmacismacimvajatpadokzajokvadakhajakhadakvajaknejemfigyufigyikarjamacikokaitbuziksavakvasakmozidfajukkutakfogakkapnalopniverikkapodbacikizmokkapuklufikmamikmozikmukikpacikpapikpicikpipikpofikropiksapiksaruktabuktaxiktiniktinisdobtamartafialtsebrefaladejtverezekszevabeleddaloddalonpadonzabotmagoddalrafalodfadobtavondurcifonjalopjahintihitemmernidobjaunjukfaljalakjafalunarconarcomkapunlakvafalokficakpacimpacinhabotbakotbuzisapadt";
            const Wordspacing = 5;
            const Words = [];
            for (let i = 0; i < read.length; i += Wordspacing) {
                Words.push(read.slice(i, i + Wordspacing));
            }

            let points = 0;
            const state = {
                secret: Words[Math.floor(Math.random() * Words.length)],
                grid: Array(6).fill().map(() => Array(5).fill('')),
                currentRow: 0,
                currentCol: 0,
            };

            function updateGrid() {
                for (let i = 0; i < state.grid.length; i++) {
                    for (let j = 0; j < state.grid[i].length; j++) {
                        const box = document.getElementById(`box${i}${j}`);
                        box.textContent = state.grid[i][j];
                    }
                }
            }

            function drawBox(container, row, col, letter = '') {
                const box = document.createElement('div');
                box.className = 'box';
                box.id = `box${row}${col}`;
                box.textContent = letter;

                container.appendChild(box);
                return box;
            }

            function drawGrid(container) {
                const grid = document.createElement('div');
                grid.className = 'gride';

                for (let i = 0; i < 6; i++) {
                    for (let j = 0; j < 5; j++) {
                        drawBox(grid, i, j);
                    }
                }

                container.appendChild(grid);
            }

            function registerKeyboardEvents() {
                document.body.onkeydown = (e) => {
                    const key = e.key;
                    if (key === 'Enter') {
                        if (state.currentCol === 5) {
                            const word = getCurrentWord();
                            if (isWordValid(word)) {
                                revealWord(word);
                                state.currentRow++;
                                state.currentCol = 0;
                            } else {
                                alert('Nem érvényes szó!')
                            }
                        }
                    }
                    if (key === 'Backspace') {
                        removeLetter();
                    }
                    if (isLetter(key)) {
                        addLetter(key);
                    }

                    updateGrid();
                };
            }

            function getCurrentWord() {
                return state.grid[state.currentRow].reduce((prev, curr) => prev + curr);
            }

            function isWordValid(word) {
                return Words.includes(word);
            }

            function revealWord(guess) {
                const row = state.currentRow;
                const animation_duration = 500;
                let finalpoints = points;
                for (let i = 0; i < 5; i++) {
                    const box = document.getElementById(`box${row}${i}`);
                    const letter = box.textContent;

                    setTimeout(() => {
                        if (letter === state.secret[i]) {
                            box.classList.add('right');
                        } else if (state.secret.includes(letter)) {
                            box.classList.add('wrong');
                        } else {
                            box.classList.add('empty')
                        }
                    }, ((i + 1) * animation_duration) / 2);
                    box.classList.add('animated');
                    box.style.animationDelay = `${(i * animation_duration) / 2}ms`;
                }
                const isWinner = state.secret === guess;
                points += 50
                finalpoints = points;
                const isGameOver = state.currentRow === 5;

                setTimeout(() => {
                    if (isWinner) {
                        showModal('Gratulálok kitaláltad a szót!', finalpoints)
                    } else if (isGameOver) {
                        showModal(
                            `Sajnálom de nem találtad ki a szót, sok szerencsét máskor! A szó ${state.secret} volt`);
                    }
                }, 3 * animation_duration);
            }

            function isLetter(key) {
                return key.length === 1 && key.match(/[a-z]/i);
            }

            function addLetter(letter) {
                if (state.currentCol === 5) return;
                state.grid[state.currentRow][state.currentCol] = letter;
                state.currentCol++;
            }

            function removeLetter() {
                if (state.currentCol === 0) return;
                state.grid[state.currentRow][state.currentCol - 1] = '';
                state.currentCol--;
            }

            function startup() {
                const game = document.getElementById('game');
                drawGrid(game);

                registerKeyboardEvents();

                console.log(state.secret);
            }

            startup();

            function showModal(message, finalpoints) {
                const modal = document.getElementById('modal2');
                const modalPoints = document.getElementById('modal-points');
                const hiddenPoints = document.getElementById('hidden-points');

                modalPoints.innerHTML = `${finalpoints} pontot szereztél ezzel a játékkal!`;
                hiddenPoints.value = finalpoints;
                modal.style.display = 'block';
            }

            document.getElementById('restart-btn').addEventListener('click', function() {
                document.getElementById('modal2').style.display = 'none';
            });
        </script>
    </main>
@endsection
