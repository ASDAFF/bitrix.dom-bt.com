function OnMySettingsEdit(arParams)
{
    var arElements = arParams.getElements();
    var jsOptions = JSON.parse(arParams.data);

    var completeAction = function() {
        var obButton = BX.create('DIV', {
                children: [
                    BX.create('LABEL', {
                        children: [
                            BX.create('INPUT', {
                                props: {type: 'text'}
                            }),
                        ]
                    }),
                    BX.create('SPAN', {
                        text: ": "
                    }),
                    BX.create('LABEL', {
                        children: [
                            BX.create('INPUT', {
                                props: {type: 'text'}
                            }),
                        ]
                    })
                ]
            });
        BX.proxy_context.previousSibling.appendChild(obButton);
    };

    var inputsFields = [];

    for(var i in jsOptions) {
        if (typeof jsOptions[i] === 'object') {
            for(var ii in jsOptions[i]) {
                inputsFields.push(
                    BX.create('DIV', {
                        children: [
                            BX.create('LABEL', {
                                children: [
                                    BX.create('INPUT', {
                                        props: {
                                            type: 'text',
                                            value: ii
                                        }
                                    })
                                ]
                            }),
                            BX.create('SPAN', {
                                text: ": "
                            }),
                        ]
                    })
                );
                if (typeof jsOptions[i][ii] === 'object') {
                    for(var iii in jsOptions[i][ii]) {
                        inputsFields.push(
                            BX.create('DIV', {
                                children: [
                                    BX.create('LABEL', {
                                        children: [
                                            BX.create('INPUT', {
                                                props: {
                                                    type: 'text',
                                                    value: iii
                                                }
                                            })
                                        ]
                                    }),
                                    BX.create('SPAN', {
                                        text: ": "
                                    }),
                                    BX.create('LABEL', {
                                        children: [
                                            BX.create('INPUT', {
                                                props: {
                                                    type: 'text',
                                                    value: jsOptions[i][ii][iii]
                                                }
                                            })
                                        ]
                                    })
                                ]
                            })
                        );
                    }
                }
            }
        } else {
            inputsFields.push(
                BX.create('DIV', {
                    children: [
                        BX.create('LABEL', {
                            children: [
                                BX.create('INPUT', {
                                    props: {
                                        type: 'text',
                                        value: i
                                    }
                                })
                            ]
                        }),
                        BX.create('SPAN', {
                            text: ": "
                        }),
                        BX.create('LABEL', {
                            children: [
                                BX.create('INPUT', {
                                    props: {
                                        type: 'text',
                                        value: jsOptions[i]
                                    }
                                })
                            ]
                        })
                    ]
                })
            );
        }
    }

    inputsFields.push(
        BX.create('INPUT', {
            events: {
                click: BX.proxy(completeAction, this)
            },
            props: {
                type: "button",
                value: "+"
            }
        })
    );

    var wrapperInputFields = BX.create('DIV', {
        children: inputsFields
    });

    arParams.oCont.appendChild(wrapperInputFields);
}