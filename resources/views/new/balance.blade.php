<!doctype html>
<html lang="en">
<head>
    @extends('new.header')
    @section('headerTitle', 'Balance')
    <meta name="description" content="Transaction information">
    <meta name="keywords" content="history, balance, invoice, keys, transaction">
    <meta name="author" content="support@securecheats.xyz">
    @include('new.style')
    <style>
        @media screen and (max-width: 600px) {
            td:nth-child(3),  td:nth-child(1) {
               text-align: center;
            }
        }
        #order-listing_wrapper {
            overflow-x: auto!important;
        }
        @media screen and (max-width: 1200px) {
            table {
                table-layout: fixed;
                min-width: 600px;
            }

            #order-listing_wrapper {
                overflow-x: auto ;
            }
            td:nth-child(4) {
                white-space: nowrap;
                max-width: 250px;
                display: block;
                overflow: hidden;
                text-overflow: ellipsis; }
        }
        @media screen and (min-width: 1200px) {
            td:nth-child(4) {
                white-space: nowrap;
                max-width: 25vw;
                display: block;
                overflow: hidden;
                text-overflow: ellipsis;
            }
            td:nth-child(3),  td:nth-child(1) {
                padding-left: 2.5em!important;
            }
        }
        table.dataTable.row-border tbody th,
        table.dataTable.row-border tbody td,
        table.dataTable.display tbody th,
        table.dataTable.display tbody td {
            overflow: hidden;
            text-overflow: ellipsis;
        }
    </style>
</head>
<body @if($theme == 'dark') data-theme="dark" @endif>
@extends('new.master-layout')
@section('content')
    <div class="tab-content mobile" style="display: flex">
        <div class="row bg-white">
            <div class="col s12 m12">
                <h5 class="row">TRANSACTION HISTORY</h5>
                <table class="striped display compact" id="order-listing">
                    <thead>
                    <tr>
                        <th>Order ID</th>
                        <th>Action</th>
                        <th>Balance</th>
                        <th>Content</th>
                        <th>Verify</th>
                        <th>Time</th>
                    </tr>
                    </thead>
                    <tbody>
                    @auth()
                        @if(count($histories) > 0)
                            @foreach($histories as $history)
                                <tr>
                                    <td>{{$history->id}}</td>
                                    <td>{{$history->action}}</td>
                                    <td>{{number_format($history->amount)}}</td>
                                    <td>{!! $history->content !!}</td>
                                    <td>{!! $history->need_to_verify == 1 ? '<button class="btn btn-small" onclick="guideVefify()" >Verify</button>' : '' !!}</td>
                                    <td>{{$history->updated_at->format('H:i:s d/m')}}</td>

                                </tr>
                            @endforeach
                        @endif
                    @endauth()
                    @guest()
                        <tr class="odd">
                            <td valign="top" colspan="5" class="dataTables_empty">No data available in table</td>
                        </tr>
                    @endguest

                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <script !src="">
        function guideVefify() {
            Swal.fire({
                title: 'Please verify payment',
                html:
                    "Make Support Ticket on our Discord to resolve VERIFY PAYMENT. Supporters will guide you step by step." +
                    "<br><br>" +
                    "<a target='_blank' " + "href='{{ \App\Option::where('option', 'discord_channel')->get()->first()->value }}'>" +
                    "<h3 class='blue-text'>Community</h3></a>" +
                    "<p>OR<br><h4>Contact us on Tawk.to in  to resolve VERIFY PAYMENT</h4>" +
                    "<img style=\"max-width: 100% \" " +
                    "src=\"data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAIIAAABvCAYAAAAg2RihAAAAAXNSR0IArs4c6QAAAARnQU1BAACxjwv8YQUAAAAJcEhZcwAADsMAAA7DAcdvqGQAACCaSURBVHhe7Z0JmFTFtcdPz74wMMwgyL7KFgSigIoriS+CiEZNFJdEjVnEp4nxS6JJ9GmMmsT3Eo1JNC/RaFzyNF80BjfcAFEMCqjsDLvAyA7DLMw+/c6/+p6e0zX39jJ9e6ZBft9XX1Xd7ul7b9W/Tp1a7p1AkKGjfObJcOKjfMY5KoSjGI52DUkyb9un9NDHa6goJ4u65eTShGN70BWjhjmfHj4cFUISVDU00ox/vk6/PuskOrFXD5P/78XLqU+XArpu3CjzHQhl9oatNKKkGy3euYd6FRTQj08ax8LJNp+nC0e7hiRAJVfU1xsRAFTuDyeONRUOIIyfvruErhw9zAjj0XPOoIuOG0j3sVjSjaNCSIJFn+42LV0T4FDb1GTSEMqhxqawUMCEY4+hT6trnFz6cFQIDkt37aU/LltD35+3iL75+jsm/Wn1IedTdz7cvZdGdC92ciGW8O/kZGaa9IecRjehqWYrAUuRbnzmhYBWe+7zc+jJ1euNab9i1FC6buxI89m1ry+gsv0HTdqNnTW1NJGdQ83a/RV0cu+eJr1i735XoQwt7urk0ofPtBDuff9jenrNRnrkS2fQA1NOMd4+TDcC+vQHzjqFvj//3863I1ni+AHDXSoaLR4WZmtlTZuuA0I5pU9IKOnEET1qgGmfvfETk+7LJnrG0IEmDf532Voq5776rlNPdI64g64CVgLi0Pz2w5X0j3Wb6Z2ZM5wjIWBBPq2pCVuSKf37RIgB3c5dk0+M6DJwnU+v2UBlB1qtzwT2K87n67W7llRxxFoECOCbbNpRkCjUci7s/1q41Hy2wxT8euPhC+i7URk7aiL9ArtFCxgZTOgVKQ6A76PyYVEQ7L/fXFEZrlxYDlwTrhPf++GEsWydTjddE7opWCMIsSN8iiNKCGhZMMl/L9tknL1nz/uiaVVi6gFM+o/fXWysgx7L3zR/kZkD+NeGkAUR8JtFOTlOrpX1Byo9ReLFOm7xxXm5Jo3KnfnSXJN+5aKp5jrl93C96KZw/VMG9DZCSbUYjgghwAzD5KLAXuCKfHzVOprFFW9P2lwwbCAt/HQXfbx7H31hQB/nKFsItgLS5+vKxfEP+Lhd4ThffXMzO4qRFgEifJEtEWIEmzL2D87od6xJf/uNd+is/r1jdk0QCAKEnUqOCCHc+s4HdMHQAaZl/ZwLFi3pRBezDT5iEYDh3Vsrt7K+0VgImGWYdQAR3DSPTfOJY0xeU3agwsT6N8DDXFm3s6m/9rUFJqCr0axlAZ3apxc9+NFKamHXTHdNAJV96UtvGTFp0AXByRQw0sF3/bQSaS0EtNJQSw+N691uHIWy+WCVkwsBS4B+GKZeVwbMfkFWlklra4EWDwHBJIuvcMmLb1E+f/ecQf2cb7UiE0m2xdlaWR0xeTSyxB5R7GGntZAeX8n+CfsDGpwT9whrM3frDudoiOrGxvC50O3Br4Df87uPVpn794O0FAIqHEO7Py5fawoMXjb66mh9pV14QApX0m9uLQ+beVS4BqYcBTzt+TlGQDgPuhC0UPucsAj2/AAsyPQh/c008tDiInNMiwLASYXVOK571zajEFS0OJh2dwHHFF0ZJqh++cEyuv+sk83f/+Sk8bTlYLUpm2RJOyGg0K97YyF9aWBfY6pRcWjdKBw4UJj8kaEZEM8dLcOuXPwdfm/8E8+byr3t5PGU68z6YbyvwbQvRhotzmAa5/746xdRn8LC8BBU2FhRFfb8BVivsceUmPT2qkNt/AoIbUhxV3pty/Zw9yPguuEHiBC0pUE38RSLGH9z/VsL6ds8otAiwjkxukBXdM2ct9ttIdJOCH9ZWUan9+vVpsUAFBZaw01841I5KDQ4XcAuBBFJF/4OhHTu4AEmD+ZujfwufAR852ujhxkRyPmxYKQtgrQ+20qg/8f58DkcSXukgT5+BPsUbk4mRiywPBArLJhYMhyDz3HvaRPoG1zRY3qUhEc/AvwU+ESwRI9NPdOcvz1iSDshPLZyXUSLt0EFYcZPm30ZAdjdA46f2a83veoMz4C0RggJwzmNtEotwqdWbwj/LZAFI5wfFTd/2w7T2lfvO2BEKZ9XNTSYWFiycy/1KMgzae34gT6FBeae5Z5EENuqQhNeC8t3UQ37CWgENtp6AFjNOZu3O7n4SUsfATNzGhSQBmYX08Iw7+jXpXLtloA+GgtDurDwt7254AHMqdswD6DPx2QOUTCiG4BI5O9xXRhZ4HfG9yw1xwRUrDi5CHAUexXkm8/msXg0GD3AIsGywRohP7hbEb128TQqzs2lZ9lBvJ/Fr+8DIobFOP2ZF50jrciiVyKk3RQzvHXc5LszZxiTDlDgKFjbiQIQApw3ePhw7rBmIF0FQGWeP2xARL8soxEB4oBZR0FDXBjvw/SjMp6YdlabVofPULnSsvE5zivIPWiuGTOcvjp8iPFxAEYpesrbBn4Npq/PevYlumPyCRFWCT4FnFpcByyAHobivA8sXUkPnX2qcyQ+Mu9knHRasHzvAXMzY48ppUFcEaBHfh7913tLTf83RU0EAeQbmlvoXWM+m0xr0N9pbGnmz3ZHTCD14SEcKh+TS/jbfbX1ZqUQIsA58BvfGDOC7jjlhDYiAHA4T+3by0xQIUwd3N/5JMRXRwwxVmQEDx8h5lP7HkvfYicP94GpbtwfrAIqchw7e3YLxucvbdpqhruwQN87IXIu42uvzqf6pmaq5XD7KZ+nUv5dACt264LFdM9pE81vw9rNYec0EAiY+xBH2Y20swjS94oHLaAFoyWjZbhZBvT5+DugF4JQIGiF9uIQwGf4O8SCtg6pAOdCV6IthlgrnBuWD11cT/YnUNGYJNPXgntcWL6TjueGIhNP+Ds4pyifyX160b66OnMeOJKYy8DwE+fDeWA93O4t7YSAgkDfh5aA/lLATcODxo3AHLoR6pcXsNmdENE94PfQx9pDvs4ClYSuxfZ9BHRJuw/V0peHDYow+3BMb1nwAb351XON5YJ/Aisg4P5g7bBopR1egHPifBA+ygLi0aTlMvRp7AChH8Q4XsCN4ObtG7CBGDCuhljwN7hxOHcYXqUbuD60/sU8osBoAy0VXRhi+Dao2L/z0BDdCyocvsdvp0ymE3q1OqawAoeamugX7y8zQ12vRiKI5cSQUzeMtBQClA71o/Ls2TkBBYM+1B5X4zhML0QDCrKz6B8zzk4baxAPuHZxKiH8WeNGm0mlYcVFdOuk8ea4ADFBILPGj4pwKAX4CRCWXheBZYCPoi1uWg4fZcJFdgPbQCS4eZhXjBoE3CCOZ7JzJCt77112ftIiQFtJJCQLrldaNiwcGkZ1Q0MbEYC7F31kHFZbBGgQEBMaBcpED5Px27BAEJGQlhZB/AS0BpgwDcwaKrwnj8nRj9pgPP+7L0x2dYjiIZXFAe89EdBtPGwengkNT+17QkWewd3oAnaE3e5X+yF2VwDnG+s40tWmpRCA+AmvXjw1PIEDIASM8x/hbkNEAfAdL/MYi84qgkSFYQNrsKWyOsLEY3QASxrNV0C5XvDC6/TWJdOdI2naNQAsswJ7TcCYNcdThkeN4RXUDsEkIgJUvgQ39OfJBi9ifR6L5Xv2O6lWMCWOBgJnU48oNHjAZlLvUPcLq4Lvd7gQYPblQu0NGBqZAIKXq4F5gxmEtyz5WCMJIVrl6M/05/bxRILgdVzwOh4LlAOsI1q4IGWBbmXac3OMDyXrIYjRJbz5STn95KTPm/K/6tX5PNTs0bFdA/osXCA8/aLs0HQu8lg3cOv/ZB5ddw/oCh78cJUZS7v1i154VYAmnu8kgpvpt4/F8x0vZK3EnnxDOaN7gEWQ0ZOAUdR9p59Ej65cS6NLu4fqgsuxw4SAnTXPrd/cptKNhViyPKKfE2QYiVYPsw/R4PtYk79+/GjnW9GJVbn259E+A27HhEQr3istuB3TwFrKqMlt7QIigNONK8YKJ6a8hxV3pWfLNprNPnrSqUPWGrAz55Z3PqBnuC+3WzHm37FEi+OYFdPgs9kbtxrrAOuBNQEoeFYcIohViZJ2OwbstAQhkWNu+CEIlBeWqPfV1XMj2WGe3UBlC/grfP7SheeY9Q+sq2C/B3wqzF5qOsQifO2V+WaRRpsvDVo9VvLcPocVgAOEm76SHcV4/AH7ltwqJlYM3I5p5HisypN0vDHQaWDnBbT6S7jVi58Ay4l5BTQsDD1L83NNg0L+kRVldCkLwi5ndC8pF4L09fDuZRyLfh43IPPouBD0aV5CSQR9O25ptzjaZzoGOm3jVpHR4ljfAV5pDcoY3aieNALYqPvFgX3Z8e4dHh1AEDJtje9jDyUc75QLQfoxvW6AtXYgU8jiREIcuGAMEfViSzzYtyH5aLEEndfpjIwMqgxm0JbGTFpTn0kra4nW1nG+nmgvN0CODHhkpQf3eANzgjQqP0ify+M4t5kGZjVR10CLqUBdyXZa56PFgp0XUKGYikYZImDkpRsXGiDEgFVI/VgeJuFSLgRUMoIWgiwpo6+CqYdDgwsXRxIriBBDvPMC9i1IXsd22vNYRiataMim5yoy6bkDAToQetVBu+meRXRRcQtd2LWRjs9ppOyMtpWvgz4maR0Ldl6DBjXjhdfo12eeHLEKiy4YlkNAI8SDQHAaO2weQU9uYGoTqoQIYJ5EmTJHAF/AnkjyQipTcK1cJ7S0tLQJzc3N5rPtLTl0574u1H9VPk1bn0WP7EleBAC/8ejeDDpvUy4NWtuFbt+dT5vrA+a8btdjXzMCkFiw8xqsIzS3BNnsrw77DphxRP74HiXhh3lgkWXk4IsQ0JrRymHy0Q0gL6BigX6mEAK4f0poIyb6qGPYmdF/A9yeN7TRhSGFFk+QQkerWtOcR1/ZVkiT1mbTn3fz7zi/lwrw2xDF5A35dPHWAlpel+lZ+dGCoNMaGX2hgWFLG+oGC0/lVYfoyXPPCj/Mo/FFCN95410zQQSV4dKw6oU+H8juG/RPegYMhHyCBsrOzIjYdYT1+UFduzg5d9wKRMcSpNJ1wPFPgzk0c1sBnb0ui96LfFCqQ1hUk0FTN+XRZdsLaXOd93VKAHYMdFqAZZXyRANDN4yNs9H2ZCTtI7y7fRfd+8FHpr+X1o8TY4+hbI2SGTDkxRJE44Qn/0lvX3pe+Pds3ApCx25BCjYjM5Pu35dH9+3w7mM7g5uPaaSbe9RTBlspOKmwVm4B2DHQaQENDbunUY7SIL1IWggz2dHDA6e2lw8lopuAd3rj+DF0w9yF5jgcQLc9hwIsxzz2D7C66Ia+XEnrWAfdqpAupzy65pNsWt129TotGMWjjT/1OURD80IVi+AmCmDHQKcTJemuAU/42P07gArR+uH938MW47KRQ81xGU7a3QTAIshvlq7kv2vdGq5BhdrIMalwCSICxOCthkI6if2AdBUBWFMXoNM3FdIrVVkR1y9pCUBijduxeEnaIsi+ATiAP5o4znVrGZwW7COEA4jVMoB+DOYKY114uf/auNV0KfeePiHi0TSNvlSkJS9pBF1oSKNF/aEin+4ub39r6Qxu7dVIN5ZwV6Esgm0dgE4DnU6EpIWASr594ZLw9myY/h9xNyEPpwiwGt+fv8g8urW1qoZqLIuAVbFbJ43znDvQlylpxHbQLQkFd8eefPrT7sNLBMK1pU10V8+6sABsIUgAEgOdjpekhIDKxUwVNorsqqmlXYdqqcE8AJptxOD2JA++j/VwWA58H8AqwDrIFLSNvkRJI7aDFgEK4869BYetCIRvlDTSz3u1WoZUiSEpIWBGEI+N461jeCMY1gswOhCfAWNVjFn1VjMAPwHzB3iYNZFFJB3bQYsAPFxZeNh1B17c0rOBvlvakJAYJI6XdgvhqTXraf62na77CNDXY1lU1g8w320vKKFLwePtj37pDE9LAPTlIS15SWsBSJjb2IWu2tThm69Syp/61tL0rs1GBG6CADoNdDoW7RbC5P+bTY+dc2bMFg3rgLEsBIFt6np/Pea+8a7DaBst5fJ0rINUvqQxRMTo4EjknSE14aGlFoQOQGKg09FoV7NBa8azA1oEqHC3zZIymYHKtl8+hVlFvDzCC1SuRgvADhABJoswT3Ck8q3yfGp2RO8V2ku7hACTb5tzVDiuA84g5gnQ2t3mCjRvc9diz3kL+qbcbhDHxBJIeGB/flrPEyTL2voM+vWenPD9yv3buB2LRbs7UlgFrCmgwgWIAzOM5w8dYFa6MMeABQ/MFuqnfwFEsreuzsl5IzclN28HFAbCzkD6TRunggf25YbXJtzKA0Fj571ol49gHL15rU/iolVjuGibfggAexFkFAGhyCPnGDlgp0zvGENGHSNIAYgAENAPXl7ehd6uNF9NGf1yiM4tJhrE/XRpFlFJ6E19tL+JaB+HLazrVyqItke+Ncd3Titspmf6Hwr7CeIraJ8B2HE02iUEVC42k+q5A+A2mQQR4IEK+xmGaLuQ9CUhbQctAoSyYGgVMVVczb3Xl0uIpsT5dv15LMgX9hM97v7opi+8PLCGxheEdlFpMdhB0Gk3EhYCHrPC20XumjzBOHuYP0DrhpUAaO2oZHu4iCHl3Ys+Nhsp8SqbaLuP5JJ0LMEWAbikvCglS8kQwDUcxkduro6bj2uIHmMxpEIQk/Kb6PmBtW2EoAUB7NiLhISAIeB09gteVhtRBXwGJxKTSvAbMKLACyt0dwHrAGsCsXhtVNWXI5Wvgy2E8mAunbwu9KJrP7mnP9ENodcmJ83vdxL9dJuT8ZF3BlfTEO6mbDHYQdBpm4SE8N25/+au4JDZexALiALPK4xkQdhTzfctXmYWqNzQlyOVL8EWAcJdB7qabWV+8t4Yos+FXoDmG6t4NDN5pZPxiauKG+ieY0PTz9HEIEQTQkKjhvd37I65wUHA9+ADuK03ZGfEfv2blyAi8vw7j/osghXstvgtAoDfxG/7yRMVOdTY4lIuTh7odDTiFgJMP94aCtOOB1gRowuwh4WxwPfPdF5Vb2NftH1TQPKIVzXl+rrH8OHBRAP872XC4LdxDr/AvS+rCzWqRMrOjYS6BmyA9Kp4+AzYNInH2fHoFdKYNbSXo/EyqF+dMcnJRaIvBWkd7C4Bu4B/XtHNt25hRneip6K/fsg3rtxA9OIBJ5MkX+9WT/f2Di1IJdM9JDxqkL4fj6hhxBBr9hDI7CFGGVhy/s7Y6I6ijhFQ8RLLNnAwdmNXX7acg5dH8vg88nHAlPEuj3Cmr3UySVKcGaQVw6pM5WdmZoZFoMUA7NgmYSHYYCSAXUfYk4DuA6MGHHOzHNiDEG0nrVyKjrUIJEAM1YEsGl3WznGdxVWs0wcHOZkO4rtbiP7q07ByxbBKKsluaxEkBikXQjQgDHlJNbapxVqp1AKwgxYB4tUt+TR1Q+xnH+Lh2eOIpkb++4WUM6eC6NL1TiZJZg+ophMKgmGLIAKwA5DYpt1rDfFgppS5W0CIZwOKF1oQkseziH5wLLswHS0CgHPi3H4gZWGXkxten6VUCIkQ7eI18r1Vde7KTpTp7CR2Fn6de3V9Rtzl50XaCMELfYOSRoynkv0AGz06C7/OXaYsgmALw87bxCzN4IZvU3DbfU4u9bhdMI7Zx/Fouh9gFbGz8OvcWxtbq9GtrOIhqhCCZTOJGubx0ODPFFzxOaKdf3E+icG+F/n7Iyi4MvbjbdHwEgXA+wn8QJaSOwO/zr2/2b1rSEQQbYWAyq5aHEpnqnXXzAYK7v8FBdecx+KI8a9idtzO3+exfsY+Iwq/wQ36ZBCoKrSC3in4dW4/yiJCCME100OVve1ybtHjKdCFW3RLX+dTh2AZBddNoeCWW50DbQlmtP4rnuDuPzqp9GSF+zspO4TOPLdNpEVoVv9LKbPGiIIyu/DxEc5BB/zVoeeMWGK2+OZ1TiJ5tKnza0mgrBP3OPp1bikLr+4hni4iQgiB4U9RoNmapGELwCaA7VgJBRqtTg1i2XUzBVdNae1OmECLmvHjMwQ33+JkkkNPhuCdRX6wPva2yZTh17lL0A0nSaRF2P86BXOO5wq3xjVZrKjCfRSsbWJL4LLHMLA91J04gghmj3Q+cKh+yUn4B15c5QeojFWdYKJxTr+EMCA7JAS3WUM9qxiNViGgAtEVNC+lYIBtVh0XdLMq7Az+MfiOgUqig+yyy79M1UAQn1xGdKD1fygY2NGMe8QRJyPzkm8FwrOh/xveofh5zuE5ya+8tQohtzfbcCedxZWex0qqZ7cWQZPP3UMRhxoWQxVXsC0ICKYLH2uMrKjg3iecVPx4KRnHR+f6J4S/Y3DTjrL8zQ6iv+0lmnuQzPMU2M2MtoMV0a3syq/kVv/vqtBqowbnwjn9wo+yaBVCTj+ufB4aKoIFjk+AStegsovYlyjkjhoV3mRdCD7Pjux1KKM8wo9IBG3eJB6R7dNEArODfyrRisEu5Z/xKHrWZqIL2YU6ZSXR4I+4v15CNIjj45cTnbqKaOratnMeOBfO6Rd4p6Nbo3E75kVEbQWG3k+B7j9lK6BaeW6msQKBgyxxq5WbCsfnWValexD85IdOyhv74nVep/tn+PvwwNPcshPZ24Dt7djlHAt8D0HAOXAuPxmU3Wq1UUaJCECIrMHtv6LggXs4wULQVoArPNiNBylo+Tju5h/EBVuFWJNRcYAbLaJm8zJLv8CY/m6+vET47SCiXw4g6uayEJrLdXEz97Z/Db0xKAzO4ef8ATamFDvn92o0IJY4IoQQrNsYSuTyYTcrAP8AAaMHuzuIB/7Z4OYfOJlI4lWxfA/xhd38nRZ8ZHfim0Vm9Qrtbrq3P9FXSkMB6TdGE93Bva0Gv41z+Mn5XUKWMd7y8yJyYwq31uC6L3KFqUoWCwCfwAbH0T0kSKD/3/j3Jjq5VuRSZBJEB3tjCuJljbn05a3+7FLSPHMc0TSf9yi8fIDocvf/95kUz/WtpImFoSeektuYUvO+k2TYYQz0/p/ISSU4hHmOdXBzCttBcHvsfxGhL14jxxFGZdSa/0ngNzPXE13m0+6hg2y0ZpSlRgS493F5IUcxWlnFQ0bwYOhN6WFKZ7BL/hq3dvU8Ao8AjI+AbsIeTraHBKad5WZ0kON4wfXVJQl4eAmAh1knrCB6M7Hd+hHgcbfjlxEtSNHDuVd2rTNlANzKJxEyqPINoro1TtYBlmHMmxQouJwrzTkG4B9glNBuZ9EBnkmUCaZoN6FvGOHqotRNC2Lm72LW7Pe2hJ5jjIcK1uVTPCq4gK3ATfx3sAip4tri+oiyEHQa2Hk3MgL9H6bglivaigEM+hkFhsxmS9D6v4gN7ewSYuF2wXIMsZ1G6J/ZSCcXtsNxTQA8xIq5Ai9q+PTP7ye6bjPR59mK/CfH81P8iP7EvEYalOP9vyDciPoZO2JBqniegnsepEDxxUQlV1HEPgRh890s7yco6MccP1uUwPD5oUksC1yOHSPAQZRYO40IKxuyaca21D6UcHmPyKeUGvjyXuPu41UOs9kR7Oh9DbP7VdK4/NC7JG0nUTuLwI7dCA0fiy+iwKCnKdjIo4ayEym47XpzOILBt7Hv8BZbDh44t2foGAG75S4i0NgXrW8GQd/s6Kx6Or1Laq0CRhGQJp5Q+uYmon4fhp5YwuRQR4tgcn4jjXWcRK9KF+y8F4Fg7eog5aknj5rZpqGbKDzJOeDC/vcouOE7PJrg/jnOWUUh0MAXNmYx/13sl2iJNQDaIkisrQL2ME7ZrqbwfAZPQS2sComhs3l7QAUNYt8dIvB6ukkHQadtMoLbZhHt+V1IAADdQjQRgJLJFJi0ggKl93JzyA9NMMWBEcHgJ6OKwEYuXt+YW8BS7E2lrIYUgYWjdBDBjcWHzBK8vneg8/q4YOdtAsGmg8Hg/sfZ3eVhZNF/UOCYG919hGiwhaDyJylY9SaPKlgUWHCyLcWhXAqMeIbPMcY54I1YASBWQQcvq9DE6Rk7Ss3bx45Ehmc30ZwBlZTJLd9PawBaZxZhETCnwGKgbGufYiJAFAjVSylYvwpnoEBX/s1hdyRkCeSydCxBC0GCCGJTfYDOLk9dF9GZzO1fQUNyIx9t8xICsONoRE4xpxH6spB2C1oIWgyvsfW5flcHPdrcQTzUq4qmdWlsIwJbADoIOu1F2tpQ++L1DXoFKZhzCurpB6WduCvVZ27uXmNEEK3SddDYeS8Oi85U34ydRhAB6HBdUTVdXZw657Gj+HrXWrqhe+h/Nugg9w50Guh0vKS1EOwbsm8cQReKffy24kq6qlsnblNOEojgzh6hF2u63Z+kBZ0Gdj4aaesjCPryJI1YB/gFEruFhw4W0G8O+L9cnUrQHbhZAhGAxDoAiYFOxyLthQD0JSIteUmjsu3YDq9WZ9ONezvhRQjt4A89K8M+gZcAJJbK1mmg0/FwWAgByGXq2C2g0iXWAccwtLyBxVDW4LK3LA3APMHDPDoYnBNaQ9ABFasr3w5AYqDT8XDYCQFIGrFbcBOD5PH/Dh6sKKTfH0yvruKGbjV0U0mtmSxCJXakCMBhIwSgL1XSiN2CrnyJdRrvFLhtf1d6r9anZ+faCRaQ7i6pNGsHqEC3yk+1CMBhJQSgL1fSiL2CmyB0jH/U/YuKIlpc17GCmJDbQLeVHqLjc5s8Kz6aABCAxECnE+WwEwLQlyxpxNGClxAkbGnIoMerCujpqvyULS6hmq4oqqVreFioN5UkKgAE83tODHS6PRyWQgD6siWNWILk7QqPlce7jZfXZ9Hsmjx6uTafKpqTK+BuGS10XkEdXdClnsZy68ceQ6lMu8K98kAfl7yg0+3liBACkDxiO20Hu/KjhYMtAdrSmElrG7JobWMWreN4W1MmHWjJDL+pBO8n6J7RTP2zms0DqSPZ+8djaAOzmszDJ7oSvUI0KwDstKDTyXDYCgHYly55Hbcn6L+VtI6jYVcWYjudaJC/1THQ6WQ5rIUA7Mu3Kw2xnbaD22f6mKQ1knerDF1pdjraMQn6M0nrGOi0Hxz2QhD0bdhpyetYB/uYzkta0GmNVyUhLXlJu+X1MYklDbzSfnHECAHYtyL5aHE8aUGnvXCrMMQ6LbHXcbdYsPN+cUQJAdi341aR0WL7GPBK2+hKcksj1uloMdBpYOf95IgTAnC7JbfKtGMQ7Zhg50G0SpN0tGNun2ncjvkH0f8DQCwGiRtJzw4AAAAASUVORK5CYILwVtnBuEKIVx/JckxZBiDWAJiWwUxOFkL2Bzj9srWE/ptTOvGdvAa6paBJDSiJsKMJwUxAcqCXE+GYEwNAgwpSFgGYSReEbOui2N/lpZ+0lNMK/1F8WweDSacH8mvVXAMaUURglfteCOCYFANAYwpSRh49QQCRE12Sf+bPosdby2h1p1uP8ibG9Mx2uruwgaZk+bXG13M0bHQRIAHJgV5OhmNWDACNKEgZeSLJFIOkfWwpXmorplfbC/tsQgpNdXVOM12X10SjMkMLU0wxJJLU99k50MvJckyLAaABBSnrjSvbeqPzHt4OfcY8joR3MW/s8tGf2wvo3c4CauxOzdcuygjQPF8LXZbTQlPZCmDNojSo2fjSLZjHgezTtwW93BuOKzEA2ZZG1cuppKYeD+3tyqRtLJBtAR/t4PxAdyY19GQG35iCDqYko4uGe7pofKafTuaoAI+8jfJ2UrHH8gVSScAsC3q5txzzYgBoLB3Z1vNoiY9y7vwZ/W+lrOexMBsMuVkOT+qIw/5Qkr/Vc6CXU+G4EAMwG8ipAc2ynnivfSz8uLUvvKwj204NojecWbaS2sXo+0JJHTHKeg70cqocN2IQ9MYyy7Kt53qSffwv52rT4ZiFXtaJ1lAoy7aVRTZ4+GfCjwnRym5w3IkBmA1lNqZTHq3M/9pllSnkeCzCG80uGAKQXJJsx8oFc9sNjksxALPB9O3wxnbOzX1AL/OWnTsRaii90fSG1cuxcqCXgbntFsetGEB441k4Na6Zg1j7BHMbxGo4Kcfa53RMx2mfWxzXYhCcGi1aIydSBua2EK8Bky0LTvvc5n+FGASnBozVyIkKIBZmI8Zq9KMlAgui/wFOXrFIfMHoggAAAABJRU5ErkJggg==\" class=\"img-fluid\">"
            })
        }
    </script>
    @if(session('isShowPopup'))
        <script>
            window.onload = function () {
                setTimeout(()=> {
                    guideVefify();
                })
            }

        </script>
    @endif
@endsection
<script>
</script>
</body>
</html>


