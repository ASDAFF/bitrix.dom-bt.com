{"version":3,"sources":["components/bitrix/catalog.element/smt_projects/settings.js"],"names":["OnMySettingsEdit","arParams","getElements","jsOptions","JSON","parse","data","completeAction","obButton","BX","create","children","props","type","text","proxy_context","previousSibling","appendChild","inputsFields","i","ii","push","value","iii","events","click","proxy","this","wrapperInputFields","oCont"],"mappings":"AAAA,SAASA,iBAAiBC,GAELA,EAASC,cAA1B,IACIC,EAAYC,KAAKC,MAAMJ,EAASK,MAEhCC,EAAiB,WACjB,IAAIC,EAAWC,GAAGC,OAAO,OACjBC,UACIF,GAAGC,OAAO,SACNC,UACIF,GAAGC,OAAO,SACNE,OAAQC,KAAM,aAI1BJ,GAAGC,OAAO,QACNI,KAAM,OAEVL,GAAGC,OAAO,SACNC,UACIF,GAAGC,OAAO,SACNE,OAAQC,KAAM,gBAMtCJ,GAAGM,cAAcC,gBAAgBC,YAAYT,IAG7CU,KAEJ,IAAI,IAAIC,KAAKhB,EACT,GAA4B,iBAAjBA,EAAUgB,IACjB,IAAI,IAAIC,KAAMjB,EAAUgB,GAoBpB,GAnBAD,EAAaG,KACTZ,GAAGC,OAAO,OACNC,UACIF,GAAGC,OAAO,SACNC,UACIF,GAAGC,OAAO,SACNE,OACIC,KAAM,OACNS,MAAOF,QAKvBX,GAAGC,OAAO,QACNI,KAAM,WAKU,iBAArBX,EAAUgB,GAAGC,GACpB,IAAI,IAAIG,KAAOpB,EAAUgB,GAAGC,GACxBF,EAAaG,KACTZ,GAAGC,OAAO,OACNC,UACIF,GAAGC,OAAO,SACNC,UACIF,GAAGC,OAAO,SACNE,OACIC,KAAM,OACNS,MAAOC,QAKvBd,GAAGC,OAAO,QACNI,KAAM,OAEVL,GAAGC,OAAO,SACNC,UACIF,GAAGC,OAAO,SACNE,OACIC,KAAM,OACNS,MAAOnB,EAAUgB,GAAGC,GAAIG,kBAYhEL,EAAaG,KACTZ,GAAGC,OAAO,OACNC,UACIF,GAAGC,OAAO,SACNC,UACIF,GAAGC,OAAO,SACNE,OACIC,KAAM,OACNS,MAAOH,QAKvBV,GAAGC,OAAO,QACNI,KAAM,OAEVL,GAAGC,OAAO,SACNC,UACIF,GAAGC,OAAO,SACNE,OACIC,KAAM,OACNS,MAAOnB,EAAUgB,aAWrDD,EAAaG,KACTZ,GAAGC,OAAO,SACNc,QACIC,MAAOhB,GAAGiB,MAAMnB,EAAgBoB,OAEpCf,OACIC,KAAM,SACNS,MAAO,QAKnB,IAAIM,EAAqBnB,GAAGC,OAAO,OAC/BC,SAAUO,IAGdjB,EAAS4B,MAAMZ,YAAYW","file":"settings.min.js","sourcesContent":["function OnMySettingsEdit(arParams)\n{\n    var arElements = arParams.getElements();\n    var jsOptions = JSON.parse(arParams.data);\n\n    var completeAction = function() {\n        var obButton = BX.create('DIV', {\n                children: [\n                    BX.create('LABEL', {\n                        children: [\n                            BX.create('INPUT', {\n                                props: {type: 'text'}\n                            }),\n                        ]\n                    }),\n                    BX.create('SPAN', {\n                        text: \": \"\n                    }),\n                    BX.create('LABEL', {\n                        children: [\n                            BX.create('INPUT', {\n                                props: {type: 'text'}\n                            }),\n                        ]\n                    })\n                ]\n            });\n        BX.proxy_context.previousSibling.appendChild(obButton);\n    };\n\n    var inputsFields = [];\n\n    for(var i in jsOptions) {\n        if (typeof jsOptions[i] === 'object') {\n            for(var ii in jsOptions[i]) {\n                inputsFields.push(\n                    BX.create('DIV', {\n                        children: [\n                            BX.create('LABEL', {\n                                children: [\n                                    BX.create('INPUT', {\n                                        props: {\n                                            type: 'text',\n                                            value: ii\n                                        }\n                                    })\n                                ]\n                            }),\n                            BX.create('SPAN', {\n                                text: \": \"\n                            }),\n                        ]\n                    })\n                );\n                if (typeof jsOptions[i][ii] === 'object') {\n                    for(var iii in jsOptions[i][ii]) {\n                        inputsFields.push(\n                            BX.create('DIV', {\n                                children: [\n                                    BX.create('LABEL', {\n                                        children: [\n                                            BX.create('INPUT', {\n                                                props: {\n                                                    type: 'text',\n                                                    value: iii\n                                                }\n                                            })\n                                        ]\n                                    }),\n                                    BX.create('SPAN', {\n                                        text: \": \"\n                                    }),\n                                    BX.create('LABEL', {\n                                        children: [\n                                            BX.create('INPUT', {\n                                                props: {\n                                                    type: 'text',\n                                                    value: jsOptions[i][ii][iii]\n                                                }\n                                            })\n                                        ]\n                                    })\n                                ]\n                            })\n                        );\n                    }\n                }\n            }\n        } else {\n            inputsFields.push(\n                BX.create('DIV', {\n                    children: [\n                        BX.create('LABEL', {\n                            children: [\n                                BX.create('INPUT', {\n                                    props: {\n                                        type: 'text',\n                                        value: i\n                                    }\n                                })\n                            ]\n                        }),\n                        BX.create('SPAN', {\n                            text: \": \"\n                        }),\n                        BX.create('LABEL', {\n                            children: [\n                                BX.create('INPUT', {\n                                    props: {\n                                        type: 'text',\n                                        value: jsOptions[i]\n                                    }\n                                })\n                            ]\n                        })\n                    ]\n                })\n            );\n        }\n    }\n\n    inputsFields.push(\n        BX.create('INPUT', {\n            events: {\n                click: BX.proxy(completeAction, this)\n            },\n            props: {\n                type: \"button\",\n                value: \"+\"\n            }\n        })\n    );\n\n    var wrapperInputFields = BX.create('DIV', {\n        children: inputsFields\n    });\n\n    arParams.oCont.appendChild(wrapperInputFields);\n}"]}