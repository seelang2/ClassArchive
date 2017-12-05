/*jslint */
/*global AdobeEdge: false, window: false, document: false, console:false, alert: false */
(function (compId) {

    "use strict";
    var im='images/',
        aud='media/',
        vid='media/',
        js='js/',
        fonts = {
            'Arial': '<link rel=\"stylesheet\" href=\"css/font.css\" type=\"text/css\" />'        },
        opts = {
            'gAudioPreloadPreference': 'auto',
            'gVideoPreloadPreference': 'auto'
        },
        resources = [
        ],
        scripts = [
        ],
        symbols = {
            "stage": {
                version: "5.0.0",
                minimumCompatibleVersion: "5.0.0",
                build: "5.0.0.375",
                scaleToFit: "width",
                centerStage: "none",
                resizeInstances: false,
                content: {
                    dom: [
                        {
                            id: 'ecotour-base',
                            display: 'block',
                            type: 'image',
                            rect: ['-33px', '-281px', '765px', '808px', 'auto', 'auto'],
                            opacity: 0,
                            fill: ["rgba(0,0,0,0)",im+"ecotour-base.png",'0px','0px']
                        },
                        {
                            id: 'Target',
                            type: 'ellipse',
                            rect: ['430px', '61px', '98px', '98px', 'auto', 'auto'],
                            borderRadius: ["50%", "50%", "50%", "50%"],
                            fill: ["rgba(192,192,192,0)"],
                            stroke: [10,"rgb(255, 0, 0)","solid"]
                        },
                        {
                            id: 'paris',
                            display: 'none',
                            type: 'image',
                            rect: ['67px', '74px', '446px', '68px', 'auto', 'auto'],
                            fill: ["rgba(0,0,0,0)",im+"paris.png",'0px','0px']
                        },
                        {
                            id: 'signup',
                            display: 'none',
                            type: 'text',
                            rect: ['118px', '127px', '330', '40', 'auto', 'auto'],
                            opacity: 0,
                            text: "SIGN UP TODAY",
                            align: "center",
                            font: ['Arial', [30, "px"], "rgba(245,224,58,1.00)", "normal", "none", "normal", "break-word", ""]
                        },
                        {
                            id: 'title',
                            display: 'none',
                            type: 'image',
                            rect: ['0', '58px', '560px', '73px', 'auto', 'auto'],
                            fill: ["rgba(0,0,0,0)",im+"title.png",'0px','0px']
                        },
                        {
                            id: 'Lourve_Group',
                            type: 'group',
                            rect: ['-290px', '-172', '0', '0', 'auto', 'auto'],
                            c: [
                            {
                                id: 'monalisa',
                                display: 'none',
                                type: 'image',
                                rect: ['732px', '235px', '136px', '102px', 'auto', 'auto'],
                                fill: ["rgba(0,0,0,0)",im+"monalisa.png",'0px','0px']
                            },
                            {
                                id: 'louvre_title',
                                display: 'none',
                                type: 'image',
                                rect: ['220px', '256px', '500px', '75px', 'auto', 'auto'],
                                fill: ["rgba(0,0,0,0)",im+"louvre_title.png",'0px','0px']
                            }]
                        },
                        {
                            id: 'Eiffel_Group',
                            type: 'group',
                            rect: ['-267', '-169', '0', '0', 'auto', 'auto'],
                            c: [
                            {
                                id: 'eiffel',
                                display: 'none',
                                type: 'image',
                                rect: ['285px', '177px', '88px', '145px', 'auto', 'auto'],
                                fill: ["rgba(0,0,0,0)",im+"eiffel.png",'0px','0px']
                            },
                            {
                                id: 'eiffel_title',
                                display: 'none',
                                type: 'image',
                                rect: ['397px', '224px', '600px', '100px', 'auto', 'auto'],
                                fill: ["rgba(0,0,0,0)",im+"eiffel_title.png",'0px','0px']
                            }]
                        },
                        {
                            id: 'Champs_Group',
                            type: 'group',
                            rect: ['-290', '-172', '0', '0', 'auto', 'auto'],
                            c: [
                            {
                                id: 'Arc',
                                display: 'none',
                                type: 'image',
                                rect: ['315px', '223px', '158px', '105px', 'auto', 'auto'],
                                fill: ["rgba(0,0,0,0)",im+"Arc.png",'0px','0px']
                            },
                            {
                                id: 'champs',
                                display: 'none',
                                type: 'image',
                                rect: ['463px', '236px', '500px', '75px', 'auto', 'auto'],
                                fill: ["rgba(0,0,0,0)",im+"champs.png",'0px','0px']
                            }]
                        },
                        {
                            id: 'Seine_Group',
                            type: 'group',
                            rect: ['-237px', '-169', '0', '0', 'auto', 'auto'],
                            c: [
                            {
                                id: 'cruise',
                                display: 'none',
                                type: 'image',
                                rect: ['226px', '243px', '165px', '77px', 'auto', 'auto'],
                                fill: ["rgba(0,0,0,0)",im+"cruise.png",'0px','0px']
                            },
                            {
                                id: 'seine_title',
                                display: 'none',
                                type: 'image',
                                rect: ['380px', '224px', '300px', '104px', 'auto', 'auto'],
                                fill: ["rgba(0,0,0,0)",im+"seine_title.png",'0px','0px']
                            }]
                        },
                        {
                            id: 'Under_Group',
                            type: 'group',
                            rect: ['-267px', '-169', '0', '0', 'auto', 'auto'],
                            c: [
                            {
                                id: 'catacombs',
                                display: 'none',
                                type: 'image',
                                rect: ['677px', '200px', '132px', '111px', 'auto', 'auto'],
                                fill: ["rgba(0,0,0,0)",im+"catacombs.png",'0px','0px']
                            },
                            {
                                id: 'under_title',
                                display: 'none',
                                type: 'image',
                                rect: ['353px', '213px', '333px', '104px', 'auto', 'auto'],
                                fill: ["rgba(0,0,0,0)",im+"under_title.png",'0px','0px']
                            }]
                        }
                    ],
                    style: {
                        '${Stage}': {
                            isStage: true,
                            rect: ['null', 'null', '560px', '200px', 'auto', 'auto'],
                            sizeRange: ['320px','560px','',''],
                            overflow: 'hidden',
                            fill: ["rgba(0,102,153,1.00)"]
                        }
                    }
                },
                timeline: {
                    duration: 42000,
                    autoPlay: true,
                    data: [
                        [
                            "eid70",
                            "opacity",
                            17291,
                            615,
                            "linear",
                            "${seine_title}",
                            '0',
                            '1'
                        ],
                        [
                            "eid71",
                            "opacity",
                            19250,
                            615,
                            "linear",
                            "${seine_title}",
                            '1',
                            '0'
                        ],
                        [
                            "eid31",
                            "opacity",
                            5607,
                            632,
                            "linear",
                            "${Target}",
                            '0',
                            '1'
                        ],
                        [
                            "eid100",
                            "opacity",
                            33254,
                            615,
                            "linear",
                            "${Target}",
                            '1',
                            '0'
                        ],
                        [
                            "eid49",
                            "opacity",
                            11028,
                            632,
                            "linear",
                            "${catacombs}",
                            '0',
                            '1'
                        ],
                        [
                            "eid50",
                            "opacity",
                            14615,
                            615,
                            "linear",
                            "${catacombs}",
                            '1',
                            '0'
                        ],
                        [
                            "eid36",
                            "opacity",
                            6872,
                            632,
                            "linear",
                            "${eiffel_title}",
                            '0',
                            '1'
                        ],
                        [
                            "eid39",
                            "opacity",
                            8500,
                            632,
                            "linear",
                            "${eiffel_title}",
                            '1',
                            '0'
                        ],
                        [
                            "eid66",
                            "opacity",
                            16675,
                            615,
                            "linear",
                            "${cruise}",
                            '0',
                            '1'
                        ],
                        [
                            "eid67",
                            "opacity",
                            19865,
                            615,
                            "linear",
                            "${cruise}",
                            '1',
                            '0'
                        ],
                        [
                            "eid11",
                            "display",
                            250,
                            0,
                            "linear",
                            "${monalisa}",
                            'none',
                            'none'
                        ],
                        [
                            "eid91",
                            "display",
                            28391,
                            0,
                            "linear",
                            "${monalisa}",
                            'none',
                            'block'
                        ],
                        [
                            "eid92",
                            "display",
                            32286,
                            0,
                            "linear",
                            "${monalisa}",
                            'block',
                            'none'
                        ],
                        [
                            "eid109",
                            "opacity",
                            36793,
                            615,
                            "linear",
                            "${signup}",
                            '0',
                            '1'
                        ],
                        [
                            "eid114",
                            "opacity",
                            40750,
                            615,
                            "linear",
                            "${signup}",
                            '1',
                            '0'
                        ],
                        [
                            "eid9",
                            "display",
                            250,
                            0,
                            "linear",
                            "${eiffel}",
                            'none',
                            'none'
                        ],
                        [
                            "eid33",
                            "display",
                            6240,
                            0,
                            "linear",
                            "${eiffel}",
                            'none',
                            'block'
                        ],
                        [
                            "eid40",
                            "display",
                            10000,
                            0,
                            "linear",
                            "${eiffel}",
                            'none',
                            'block'
                        ],
                        [
                            "eid2",
                            "display",
                            250,
                            0,
                            "linear",
                            "${seine_title}",
                            'none',
                            'block'
                        ],
                        [
                            "eid68",
                            "display",
                            17291,
                            0,
                            "linear",
                            "${seine_title}",
                            'block',
                            'block'
                        ],
                        [
                            "eid69",
                            "display",
                            20000,
                            0,
                            "linear",
                            "${seine_title}",
                            'block',
                            'none'
                        ],
                        [
                            "eid10",
                            "display",
                            250,
                            0,
                            "linear",
                            "${louvre_title}",
                            'none',
                            'none'
                        ],
                        [
                            "eid95",
                            "display",
                            29005,
                            0,
                            "linear",
                            "${louvre_title}",
                            'none',
                            'block'
                        ],
                        [
                            "eid96",
                            "display",
                            31626,
                            0,
                            "linear",
                            "${louvre_title}",
                            'block',
                            'none'
                        ],
                        [
                            "eid14",
                            "opacity",
                            3080,
                            632,
                            "linear",
                            "${ecotour-base}",
                            '0',
                            '1'
                        ],
                        [
                            "eid101",
                            "opacity",
                            33870,
                            615,
                            "linear",
                            "${ecotour-base}",
                            '1',
                            '0'
                        ],
                        [
                            "eid16",
                            "opacity",
                            41250,
                            0,
                            "linear",
                            "${ecotour-base}",
                            '0',
                            '0'
                        ],
                        [
                            "eid46",
                            "left",
                            10396,
                            632,
                            "linear",
                            "${Target}",
                            '3px',
                            '433px'
                        ],
                        [
                            "eid58",
                            "left",
                            15845,
                            594,
                            "linear",
                            "${Target}",
                            '433px',
                            '15px'
                        ],
                        [
                            "eid74",
                            "left",
                            20807,
                            615,
                            "linear",
                            "${Target}",
                            '15px',
                            '58px'
                        ],
                        [
                            "eid89",
                            "left",
                            26344,
                            615,
                            "linear",
                            "${Target}",
                            '58px',
                            '430px'
                        ],
                        [
                            "eid1",
                            "display",
                            250,
                            0,
                            "linear",
                            "${under_title}",
                            'none',
                            'none'
                        ],
                        [
                            "eid51",
                            "display",
                            11660,
                            0,
                            "linear",
                            "${under_title}",
                            'none',
                            'block'
                        ],
                        [
                            "eid52",
                            "display",
                            14750,
                            0,
                            "linear",
                            "${under_title}",
                            'block',
                            'none'
                        ],
                        [
                            "eid3",
                            "display",
                            250,
                            0,
                            "linear",
                            "${Arc}",
                            'none',
                            'none'
                        ],
                        [
                            "eid75",
                            "display",
                            22036,
                            0,
                            "linear",
                            "${Arc}",
                            'none',
                            'block'
                        ],
                        [
                            "eid76",
                            "display",
                            26000,
                            0,
                            "linear",
                            "${Arc}",
                            'block',
                            'none'
                        ],
                        [
                            "eid12",
                            "display",
                            250,
                            0,
                            "linear",
                            "${title}",
                            'none',
                            'none'
                        ],
                        [
                            "eid105",
                            "display",
                            35099,
                            0,
                            "linear",
                            "${title}",
                            'none',
                            'block'
                        ],
                        [
                            "eid111",
                            "display",
                            41917,
                            0,
                            "linear",
                            "${title}",
                            'block',
                            'none'
                        ],
                        [
                            "eid5",
                            "display",
                            250,
                            0,
                            "linear",
                            "${champs}",
                            'none',
                            'none'
                        ],
                        [
                            "eid83",
                            "display",
                            22651,
                            0,
                            "linear",
                            "${champs}",
                            'none',
                            'block'
                        ],
                        [
                            "eid84",
                            "display",
                            25250,
                            0,
                            "linear",
                            "${champs}",
                            'block',
                            'none'
                        ],
                        [
                            "eid97",
                            "opacity",
                            29005,
                            615,
                            "linear",
                            "${louvre_title}",
                            '0',
                            '1'
                        ],
                        [
                            "eid98",
                            "opacity",
                            30823,
                            615,
                            "linear",
                            "${louvre_title}",
                            '1',
                            '0'
                        ],
                        [
                            "eid44",
                            "top",
                            10396,
                            632,
                            "linear",
                            "${ecotour-base}",
                            '-341px',
                            '-531px'
                        ],
                        [
                            "eid56",
                            "top",
                            15845,
                            615,
                            "linear",
                            "${ecotour-base}",
                            '-531px',
                            '-461px'
                        ],
                        [
                            "eid72",
                            "top",
                            20807,
                            615,
                            "linear",
                            "${ecotour-base}",
                            '-461px',
                            '-161px'
                        ],
                        [
                            "eid87",
                            "top",
                            26344,
                            615,
                            "linear",
                            "${ecotour-base}",
                            '-161px',
                            '-281px'
                        ],
                        [
                            "eid93",
                            "opacity",
                            28391,
                            615,
                            "linear",
                            "${monalisa}",
                            '0',
                            '1'
                        ],
                        [
                            "eid94",
                            "opacity",
                            31437,
                            615,
                            "linear",
                            "${monalisa}",
                            '1',
                            '0'
                        ],
                        [
                            "eid15",
                            "display",
                            2815,
                            0,
                            "linear",
                            "${ecotour-base}",
                            'block',
                            'block'
                        ],
                        [
                            "eid13",
                            "display",
                            34750,
                            0,
                            "linear",
                            "${ecotour-base}",
                            'block',
                            'none'
                        ],
                        [
                            "eid17",
                            "display",
                            41365,
                            0,
                            "linear",
                            "${ecotour-base}",
                            'none',
                            'none'
                        ],
                        [
                            "eid32",
                            "opacity",
                            6240,
                            632,
                            "linear",
                            "${eiffel}",
                            '0',
                            '1'
                        ],
                        [
                            "eid41",
                            "opacity",
                            9132,
                            632,
                            "linear",
                            "${eiffel}",
                            '1',
                            '0'
                        ],
                        [
                            "eid53",
                            "opacity",
                            11660,
                            632,
                            "linear",
                            "${under_title}",
                            '0',
                            '1'
                        ],
                        [
                            "eid54",
                            "opacity",
                            14000,
                            615,
                            "linear",
                            "${under_title}",
                            '1',
                            '0'
                        ],
                        [
                            "eid8",
                            "display",
                            250,
                            0,
                            "linear",
                            "${eiffel_title}",
                            'none',
                            'none'
                        ],
                        [
                            "eid37",
                            "display",
                            6872,
                            0,
                            "linear",
                            "${eiffel_title}",
                            'none',
                            'block'
                        ],
                        [
                            "eid38",
                            "display",
                            9250,
                            0,
                            "linear",
                            "${eiffel_title}",
                            'block',
                            'none'
                        ],
                        [
                            "eid90",
                            "top",
                            26344,
                            615,
                            "linear",
                            "${Target}",
                            '41px',
                            '61px'
                        ],
                        [
                            "eid104",
                            "opacity",
                            35099,
                            615,
                            "linear",
                            "${title}",
                            '0',
                            '1'
                        ],
                        [
                            "eid112",
                            "opacity",
                            40750,
                            615,
                            "linear",
                            "${title}",
                            '1',
                            '0'
                        ],
                        [
                            "eid4",
                            "display",
                            250,
                            0,
                            "linear",
                            "${catacombs}",
                            'none',
                            'none'
                        ],
                        [
                            "eid47",
                            "display",
                            11028,
                            0,
                            "linear",
                            "${catacombs}",
                            'none',
                            'block'
                        ],
                        [
                            "eid48",
                            "display",
                            15500,
                            0,
                            "linear",
                            "${catacombs}",
                            'block',
                            'none'
                        ],
                        [
                            "eid18",
                            "opacity",
                            1500,
                            632,
                            "linear",
                            "${paris}",
                            '0',
                            '1'
                        ],
                        [
                            "eid21",
                            "opacity",
                            4344,
                            632,
                            "linear",
                            "${paris}",
                            '1',
                            '0'
                        ],
                        [
                            "eid77",
                            "opacity",
                            22036,
                            615,
                            "linear",
                            "${Arc}",
                            '0',
                            '1'
                        ],
                        [
                            "eid78",
                            "opacity",
                            25115,
                            615,
                            "linear",
                            "${Arc}",
                            '1',
                            '0'
                        ],
                        [
                            "eid107",
                            "display",
                            250,
                            0,
                            "linear",
                            "${signup}",
                            'none',
                            'none'
                        ],
                        [
                            "eid108",
                            "display",
                            36793,
                            0,
                            "linear",
                            "${signup}",
                            'none',
                            'block'
                        ],
                        [
                            "eid113",
                            "display",
                            41917,
                            0,
                            "linear",
                            "${signup}",
                            'block',
                            'none'
                        ],
                        [
                            "eid19",
                            "display",
                            250,
                            0,
                            "linear",
                            "${paris}",
                            'none',
                            'block'
                        ],
                        [
                            "eid85",
                            "opacity",
                            22651,
                            615,
                            "linear",
                            "${champs}",
                            '0',
                            '1'
                        ],
                        [
                            "eid86",
                            "opacity",
                            24500,
                            615,
                            "linear",
                            "${champs}",
                            '1',
                            '0'
                        ],
                        [
                            "eid61",
                            "left",
                            15845,
                            615,
                            "linear",
                            "${ecotour-base}",
                            '-112px',
                            '-72px'
                        ],
                        [
                            "eid73",
                            "left",
                            20807,
                            615,
                            "linear",
                            "${ecotour-base}",
                            '-72px',
                            '-73px'
                        ],
                        [
                            "eid88",
                            "left",
                            26344,
                            615,
                            "linear",
                            "${ecotour-base}",
                            '-73px',
                            '-33px'
                        ],
                        [
                            "eid7",
                            "display",
                            250,
                            0,
                            "linear",
                            "${cruise}",
                            'none',
                            'none'
                        ],
                        [
                            "eid63",
                            "display",
                            16675,
                            0,
                            "linear",
                            "${cruise}",
                            'none',
                            'block'
                        ],
                        [
                            "eid65",
                            "display",
                            20479,
                            0,
                            "linear",
                            "${cruise}",
                            'none',
                            'none'
                        ]
                    ]
                }
            }
        };

    AdobeEdge.registerCompositionDefn(compId, symbols, fonts, scripts, resources, opts);

    if (!window.edge_authoring_mode) AdobeEdge.getComposition(compId).load("ecotour_finished_edgeActions.js");
})("EDGE-204064390");
