;(function(window) {

  var svgSprite = '<svg>' +
    '' +
    '<symbol id="icon-shanchu" viewBox="0 0 1024 1024">' +
    '' +
    '<path d="M693.970944 231.906304c33.959936 4.780032 69.298176-1.37216 97.028096 3.345408 44.90752 7.640064 67.670016 45.82912 62.736384 102.047744-18.123776 0-36.245504 0-54.372352 0-1.531904 99.728384-0.833536 198.555648-0.833536 298.615808 0 50.50368 4.205568 103.617536-0.835584 148.888576-4.769792 42.800128-36.119552 68.866048-74.445824 75.282432-37.791744 6.326272-87.942144 1.673216-129.649664 1.673216-87.457792 0-176.078848 1.693696-261.8112 0-41.751552-0.826368-72.511488-14.076928-91.173888-39.315456-18.664448-25.23648-16.729088-63.427584-16.729088-108.737536 0-126.232576 0-251.404288 0-376.40704-17.288192 0-34.57536 0-51.861504 0-8.421376-51.725312 13.971456-88.896512 51.861504-101.211136 27.851776-9.054208 64.98304-1.7408 104.55552-4.182016-3.19488-55.675904-0.186368-97.969152 47.679488-103.72096 21.392384-2.571264 49.959936 0 76.115968 0 47.161344 0 101.813248 0 152.237056 0 29.026304 0 58.730496-2.801664 73.608192 10.037248C698.684416 156.007424 693.289984 196.973568 693.970944 231.906304zM380.29824 183.391232c0 16.729088 0 33.458176 0 50.187264 87.2704 0 174.5408 0 261.810176 0 0-17.565696 0-35.131392 0-52.696064-86.989824 0-173.983744 0-260.974592 0C380.158976 181.02272 380.225536 182.204416 380.29824 183.391232zM329.274368 343.154688c0 105.859072 0 211.275776 0 318.690304 0 27.22304-6.258688 85.224448 10.037248 97.02912 6.482944 4.697088 23.19872 5.390336 30.949376 0 16.86016-11.718656 10.873856-68.069376 10.873856-96.192512 0-108.795904 0-219.029504 0-322.036736-17.006592 0-34.016256 0-51.023872 0C329.136128 340.785152 329.201664 341.966848 329.274368 343.154688zM484.854784 343.154688c0 95.297536 0 206.577664 0 308.653056 0 24.351744-5.6576 81.993728 4.182016 98.702336 6.501376 11.03872 28.381184 16.043008 39.313408 7.529472 14.824448-11.544576 8.36608-72.590336 8.36608-97.865728 0-109.07136 0-213.696512 0-319.526912-17.007616 0-34.018304 0-51.024896 0C484.716544 340.785152 484.783104 341.966848 484.854784 343.154688zM642.108416 343.154688c0 102.566912 0 216.736768 0 322.873344 0 33.067008-6.44608 83.785728 15.055872 92.84608 9.362432 3.946496 25.977856 0.893952 30.111744-2.507776 14.038016-11.556864 7.530496-73.517056 7.530496-97.865728 0-108.521472 0-212.59264 0-317.853696-17.288192 0-34.576384 0-51.861504 0C641.970176 340.785152 642.036736 341.966848 642.108416 343.154688z"  ></path>' +
    '' +
    '</symbol>' +
    '' +
    '<symbol id="icon-gou" viewBox="0 0 1024 1024">' +
    '' +
    '<path d="M800.06837 245.25068 387.101897 658.217153 223.927537 495.043816c-24.418133-24.416086-64.004733-24.416086-88.422865 0-24.414039 24.415063-24.414039 64.003709 0 88.419795l195.480136 195.48116c13.023618 13.020548 36.738739 18.950607 56.342216 18.022469 19.475564 0.924045 42.872436-5.006014 55.889915-18.024515l445.271226-445.271226c24.418133-24.418133 24.418133-64.004733 0-88.420819C864.072079 220.832548 824.486502 220.832548 800.06837 245.25068z"  ></path>' +
    '' +
    '</symbol>' +
    '' +
    '<symbol id="icon-19" viewBox="0 0 1024 1024">' +
    '' +
    '<path d="M957.824 793.856c0 41.216-33.728 74.304-74.048 74.304L140.224 868.16c-41.216 0-74.048-33.856-74.048-74.304L66.176 229.824c0-41.152 33.728-73.984 74.048-73.984l742.72 0c41.088 0 73.92 33.728 73.92 73.984l0 564.032L957.824 793.856zM140.224 214.208c-8.192 0-14.784 6.592-14.784 14.784l0 564.864c0 8.32 6.592 14.848 14.784 14.848l742.72 0c8.192 0 14.72-6.592 14.72-14.848L897.664 229.824c0-8.192-6.592-14.784-14.72-14.784L140.224 215.04 140.224 214.208zM274.304 452.672c-49.344 0-88.832-39.424-88.832-88.768 0-49.408 39.424-89.728 88.832-89.728 49.344 0 88.896 39.552 88.896 88.896S323.648 452.672 274.304 452.672L274.304 452.672zM838.592 749.568 185.472 749.568l0-89.536 148.864-148.8 74.048 73.92 237.568-236.8 193.408 193.216 0 208.192-0.896 0L838.464 749.568z"  ></path>' +
    '' +
    '</symbol>' +
    '' +
    '<symbol id="icon-iconfontguanbi2" viewBox="0 0 1024 1024">' +
    '' +
    '<path d="M843.741184 237.341696 786.397184 178.973696 511.364096 454.852608 236.509184 179.997696 179.165184 238.365696 453.597184 512.797696 179.165184 788.253696 236.509184 846.621696 511.541248 570.74176 786.397184 845.597696 843.741184 787.229696 569.309184 512.797696Z"  ></path>' +
    '' +
    '</symbol>' +
    '' +
    '<symbol id="icon-qq" viewBox="0 0 1024 1024">' +
    '' +
    '<path d="M873.472 772.48c-12.608 1.6-39.36-24-59.648-74.112-13.888 53.76-40.896 99.136-76.992 134.528 43.776 11.648 73.472 34.112 73.472 60.032 0 37.888-63.36 68.48-141.504 68.48-58.624 0-109.12-17.344-130.432-42.112-8.896 0.768-17.856 1.152-26.88 1.152-10.496 0-20.864-0.64-31.104-1.472-21.12 24.896-71.744 42.496-130.816 42.496-78.08 0-141.376-30.656-141.376-68.48 0-26.88 32.064-50.112 78.784-61.376-36.032-35.52-63.04-80.64-77.056-133.504-20.224 50.496-47.04 76.48-59.584 74.88-16.256-2.112-32.512-52.224-23.552-128 5.952-50.752 34.112-112.832 62.4-133.376-0.128-5.76 0-11.712 0.704-17.792 5.312-47.232 12.992-88.96 32.704-93.12C219.2 383.488 217.344 365.824 217.344 347.84c0-157.504 136.768-285.184 294.208-285.184 157.44 0 294.208 127.68 294.208 285.184 0 18.176-1.856 35.968-5.376 53.184 0.128 0 0.256-0.064 0.384-0.064 16.256 1.088 30.4 43.136 35.904 93.184 0.768 6.592 0.896 12.928 0.64 19.136 27.52 22.592 54.144 82.24 59.904 131.2C906.112 720.256 889.728 770.496 873.472 772.48z"  ></path>' +
    '' +
    '</symbol>' +
    '' +
    '<symbol id="icon-tianjia" viewBox="0 0 1024 1024">' +
    '' +
    '<path d="M567.851029 65.191768 456.148971 65.191768 456.148971 456.148971 65.191768 456.148971 65.191768 567.850006 456.148971 567.850006 456.148971 958.807209 567.851029 958.807209 567.851029 567.850006 958.807209 567.850006 958.807209 456.148971 567.851029 456.148971Z"  ></path>' +
    '' +
    '</symbol>' +
    '' +
    '<symbol id="icon-gengduo" viewBox="0 0 1024 1024">' +
    '' +
    '<path d="M390.095238 0l243.809524 0 0 243.809524-243.809524 0 0-243.809524Z"  ></path>' +
    '' +
    '<path d="M390.095238 390.095238l243.809524 0 0 243.809524-243.809524 0 0-243.809524Z"  ></path>' +
    '' +
    '<path d="M390.095238 780.190476l243.809524 0 0 243.809524-243.809524 0 0-243.809524Z"  ></path>' +
    '' +
    '</symbol>' +
    '' +
    '<symbol id="icon-iconfontbaocun" viewBox="0 0 1024 1024">' +
    '' +
    '<path d="M340.019067 783.955902l108.470457 0 0 176.008666-108.470457 0 0-176.008666ZM938.731988 64.035432 85.266989 64.035432c-11.295254 0-20.451798 9.156544-20.451798 20.451798l0 738.935546 136.762827 134.982274 62.456471 0 0-0.115634 0-30.390147 0-230.264361 411.369092 0 0 260.654508-0.641613 0 0 0.115634 263.97002 0c11.295254 0 20.451798-9.156544 20.451798-20.451798L959.183785 84.48723C959.184809 73.191976 950.028265 64.035432 938.731988 64.035432zM816.433594 514.125407l-608.867188 0 0-401.13603 608.867188 0L816.433594 514.125407zM340.019067 958.289416l108.470457 0 0 0.115634-108.470457 0 0-0.115634Z"  ></path>' +
    '' +
    '</symbol>' +
    '' +
    '<symbol id="icon-youxiang" viewBox="0 0 1024 1024">' +
    '' +
    '<path d="M743.892 264.649h-463.785c-30.543 0-77.298 24.508-77.298 54.107v10.746c0 0 261.305 215.115 309.191 215.115s309.191-214.547 309.191-214.547v-11.501c0-29.411-46.755-53.92-77.298-53.92v0zM202.809 416.226v305.042c0 0 28.657 38.083 77.298 38.083h463.785c46.19 0 77.298-38.083 77.298-38.083v-305.986c0 0-219.826 193.245-309.191 193.245-88.421 0-309.191-192.301-309.191-192.301v0zM202.809 416.226z"  ></path>' +
    '' +
    '</symbol>' +
    '' +
    '<symbol id="icon-gerenxinxi" viewBox="0 0 1024 1024">' +
    '' +
    '<path d="M422.142971 529.675568c118.674866 0 214.897372-104.229876 214.897372-232.804207 0-128.574331-96.222505-232.806253-214.897372-232.806253-118.677936 0-214.897372 104.230899-214.897372 232.806253C207.245599 425.444669 303.466058 529.675568 422.142971 529.675568zM422.142971 637.123742c-197.793832 0-358.162286 144.31278-358.162286 322.346569l716.324572 0C780.305257 781.436522 619.93578 637.123742 422.142971 637.123742z"  ></path>' +
    '' +
    '<path d="M767.547699 319.863005l191.882192 0 0 63.960731-191.882192 0 0-63.960731Z"  ></path>' +
    '' +
    '<path d="M703.586968 511.745197l255.842922 0 0 63.960731-255.842922 0 0-63.960731Z"  ></path>' +
    '' +
    '<path d="M767.547699 703.627389l191.882192 0 0 63.960731-191.882192 0 0-63.960731Z"  ></path>' +
    '' +
    '</symbol>' +
    '' +
    '<symbol id="icon-hongbao-copy" viewBox="0 0 1024 1024">' +
    '' +
    '<path d="M785.825 960.988h-547.65c-67.219 0-121.725-53.663-121.725-119.869v-599.344l365.119 119.869h60.862l365.119-119.869v599.288c0 66.206-54.506 119.925-121.725 119.925v0zM543.894 659.431l88.313-0.225c22.106 0.225 29.981-11.081 30.431-24.694 0.338-11.812-10.969-34.087-30.938-34.594h-88.313v-20.981c0 0 66.994-67.387 84.431-82.969 17.325-15.581 21.713-27.844 11.025-40.444-10.856-12.881-30.037-12.094-44.044-0.675-14.231 11.644-82.688 74.25-82.688 74.25s-58.781-59.737-71.494-71.775c-11.419-10.8-35.662-21.319-48.713-6.75-13.613 15.188-3.038 34.2 5.513 42.525 8.494 8.213 82.013 84.769 82.013 84.769l-0.112 23.006h-92.138c-13.613 0-25.65 23.85-25.2 36.563 0.45 12.6 10.744 22.5 25.2 22.5 14.456 0 91.856-0.506 91.856-0.506l-0.225 64.238h-95.456c-13.613 0-25.031 13.5-25.594 26.213-0.506 12.712 10.181 29.869 25.594 29.869h95.231c0 0-0.169 21.994 0.394 31.163 1.294 20.475 14.906 28.8 33.131 29.137 18.225 0.338 31.106-14.681 31.106-28.069-0.056-11.081-0.338-32.231-0.338-32.231s79.256-0.112 94.219 0c14.963 0.113 26.156-14.794 25.538-29.869-0.563-15.131-9.844-26.719-32.569-26.719h-86.681l0.506-63.731zM542.431 301.738h-60.863l-365.119-119.869c0-66.206 54.506-119.869 121.725-119.869h547.706c67.219 0 121.725 53.663 121.725 119.869l-365.175 119.869zM542.431 301.738z"  ></path>' +
    '' +
    '</symbol>' +
    '' +
    '<symbol id="icon-huatong" viewBox="0 0 1024 1024">' +
    '' +
    '<path d="M232.831324 895.863644c-4.717442-0.569982-9.447163-1.062192-14.152325-1.724271-14.06125-1.976004-28.577872-3.65525-40.875966-10.771321-28.263717-16.353456-48.00534-45.831838-42.703591-81.742722 2.927679-19.831674 11.447726-37.274952 23.712051-52.707432 8.363482-10.523681 17.872043-20.214391 27.54638-29.576619 3.252067-3.146667 4.629437-5.313006 4.114714-9.952676-1.826602-16.4783 3.834328-30.293957 14.529925-43.113937 43.352367-51.954279 86.169545-104.356766 129.175011-156.600641 56.272631-68.358901 112.537076-136.725988 168.81073-205.084888 0.855484-1.038656 1.782599-2.016937 2.973728-3.357468 28.662807 64.996316 75.261101 111.73685 140.341329 140.39761-1.1328 1.023306-1.968841 1.841951-2.868327 2.582825-120.494305 99.197256-241.010099 198.367907-361.448122 297.631678-7.222495 5.952572-14.482853 11.485589-23.675212 14.055111-9.841136 2.749624-19.637246 2.950192-29.42517 0.026606-2.501984-0.747014-3.983731-0.407276-5.852288 1.733481-6.980995 8.002254-14.687514 15.391549-21.415752 23.589254-6.424316 7.826246-11.159154 16.750499-13.300934 26.861788-1.394766 6.583952 0.314155 12.3247 3.89982 17.822924 5.805216 8.901741 14.762215 11.69946 24.509207 13.633508 33.408901 6.633071 63.757093-1.39886 92.326778-18.599613 23.73968-14.294564 44.403303-32.5483 65.261353-50.551326 23.957645-20.678972 47.560202-41.797965 74.091462-59.252499 27.15036-17.863856 56.135508-31.275307 88.49552-36.526915 18.9854-3.081175 38.032198-3.060709 57.091276-1.000793 54.784744 5.92085 103.423511 27.613918 148.137899 58.750055 44.10859 30.716582 82.290191 67.7398 114.591875 110.74015 12.271488 16.338107 5.256724 37.937031-14.08274 42.983977-10.17064 2.654456-19.312858-0.074701-26.27441-8.115841-9.639544-11.134595-18.568914-22.900569-28.488845-33.772174-32.305777-35.403325-68.545142-66.010413-110.957091-88.813768-26.511817-14.253632-54.558593-23.958668-84.458577-28.161387-39.277562-5.519714-75.217099 3.39533-108.457154 24.542976-23.457248 14.922874-44.491307 32.91976-65.372893 51.119261-22.62837 19.721157-45.171806 39.555901-70.13843 56.352449-25.142633 16.915251-52.088332 29.624714-82.308611 34.413787-5.634324 0.892323-11.31879 1.465374-16.97972 2.185782C243.747955 895.863644 238.28964 895.863644 232.831324 895.863644z"  ></path>' +
    '' +
    '<path d="M695.405635 57.499575c6.475482 0.783853 12.975523 1.418302 19.424398 2.375094 27.786857 4.125971 53.352115 14.21577 76.955696 29.281907 27.077705 17.283642 49.348941 39.495526 66.607 66.589604 16.414855 25.77299 26.876114 53.757345 30.223349 84.260056 2.76395 25.171286 0.709151 49.863664-8.204869 73.659627-3.231601 8.631588-7.691169 16.817014-11.874445 25.061792-0.51984 1.027399-2.90619 1.87879-4.204765 1.633197-43.806715-8.306176-84.470857-24.50102-121.283274-49.721425-66.852594-45.799092-110.517069-108.087741-131.247206-186.422853-1.77646-6.709819-3.051499-13.550621-4.634554-20.313651-0.595564-2.536776-0.148379-4.082992 2.422166-5.566786 20.925588-12.0832 43.418882-18.742876 67.50444-20.179598 1.199315-0.071631 2.382257-0.431835 3.573385-0.656963C685.580872 57.499575 690.493765 57.499575 695.405635 57.499575z"  ></path>' +
    '' +
    '<path d="M822.006008 386.68183c-8.731872 3.979638-17.226337 8.625448-26.236548 11.821233-39.429011 13.986549-78.896908 12.298094-117.688399-2.184759-57.167001-21.345144-97.911984-60.644195-122.773208-116.189256-12.459776-27.834952-17.544585-57.290821-15.169491-87.747483 1.805112-23.11137 8.352225-44.929282 20.288069-64.969711 0.343831-0.576121 0.753153-1.111311 1.281179-1.88493C602.619392 258.046101 689.204399 344.593246 822.006008 386.68183z"  ></path>' +
    '' +
    '</symbol>' +
    '' +
    '<symbol id="icon-16pxtishi" viewBox="0 0 1024 1024">' +
    '' +
    '<path d="M512 0C230.4 0 0 230.4 0 512s230.4 512 512 512 512-230.4 512-512S793.6 0 512 0zM512 192c38.4 0 64 25.6 64 64 0 38.4-25.6 64-64 64S448 294.4 448 256C448 217.6 473.6 192 512 192zM608 832l-192 0 0-64c25.6 0 44.8-12.8 44.8-44.8L460.8 518.4 416 480 416 435.2 537.6 384l32 0 0 339.2c0 19.2 6.4 32 12.8 38.4C582.4 761.6 595.2 768 608 768L608 832z"  ></path>' +
    '' +
    '</symbol>' +
    '' +
    '<symbol id="icon-diaozhengdaxiaoresize5" viewBox="0 0 1024 1024">' +
    '' +
    '<path d="M874.24 604.49792c22.29248-2.14016 42.97728-11.73504 59.2384-27.56608l0 282.50112c0 48.85504-39.76192 88.59648-88.6272 88.59648l-634.9824 0c-48.87552 0-88.63744-39.74144-88.63744-88.59648L121.23136 225.1264c0-48.85504 39.76192-88.60672 88.63744-88.60672l283.26912 0c-15.24736 15.64672-25.38496 36.29056-27.60704 59.22816L209.85856 195.74784c-16.20992 0-29.39904 13.17888-29.39904 29.37856l0 634.29632c0 16.18944 13.18912 29.36832 29.39904 29.36832l634.9824 0c16.20992 0 29.39904-13.17888 29.39904-29.36832L874.24 604.49792zM890.15296 130.44736 589.2608 130.44736c-24.53504 0-44.42112 19.88608-44.42112 44.43136 0 24.53504 19.88608 44.42112 44.42112 44.42112l191.21152 0c-1.8432 1.34144-3.6864 2.70336-5.34528 4.37248L461.6704 537.10848l0-193.6384c0-24.53504-19.88608-44.42112-44.42112-44.42112-12.26752 0-23.37792 4.95616-31.41632 13.0048-8.0384 8.05888-13.01504 19.13856-13.01504 31.41632l0 300.9024c0 24.5248 19.88608 44.42112 44.42112 44.42112L718.1312 688.7936c24.53504 0 44.42112-19.89632 44.42112-44.4416 0-24.5248-19.88608-44.42112-44.42112-44.42112L526.94016 599.93088c1.8432-1.34144 3.67616-2.70336 5.33504-4.36224l313.43616-313.4464 0 193.64864c0 24.53504 19.88608 44.42112 44.42112 44.42112 12.26752 0 23.37792-4.95616 31.41632-13.0048 8.0384-8.05888 13.01504-19.1488 13.01504-31.41632L934.56384 174.86848C934.57408 150.34368 914.67776 130.44736 890.15296 130.44736z"  ></path>' +
    '' +
    '</symbol>' +
    '' +
    '<symbol id="icon-lianjie" viewBox="0 0 1024 1024">' +
    '' +
    '<path d="M823.680129 203.199423l-2.881047-2.882646c-66.47513-66.47553-175.227596-66.47553-241.699728 0l-154.000388 154.043558c-66.476129 66.476129-66.476129 175.226197 0 241.745297l2.836477 2.793106c5.535847 5.535247 11.437845 10.521866 17.47715 15.189701l56.363985-56.412952c-6.587134-3.841396-12.810315-8.553201-18.437499-14.181385l-2.836677-2.792107c-36.096127-36.096127-36.096127-94.838899 0-130.936625l154.090527-153.997989c36.007587-36.097126 94.703991-36.097126 130.801716 0l2.884045 2.835677c36.097526 36.099125 36.097526 94.842497 0 130.894653l-69.633988 69.678958c12.076812 29.873746 17.796934 61.718355 17.249305 93.42146l107.744149-107.697181C890.159256 378.426019 890.159256 269.674553 823.680129 203.199423L823.680129 203.199423zM596.06785 425.136949c-5.532249-5.534847-11.437246-10.522865-17.521121-15.142733l-56.320015 56.364985c6.587534 3.888963 12.811314 8.5552 18.440497 14.182984l2.881047 2.881446c36.096527 36.051157 36.096527 94.79393 0 130.893654l-154.042959 153.99699c-36.099125 36.050558-94.795928 36.050558-130.894653 0l-2.882446-2.881047c-36.097126-36.097526-36.097126-94.840898 0-130.846686l69.678958-69.680956c-12.076812-29.876943-17.842903-61.762725-17.294274-93.468828l-107.78812 107.653211c-66.476129 66.521099-66.476129 175.312538 0 241.744697l2.882646 2.882046c66.47513 66.433158 175.226596 66.433158 241.701327 0l153.998389-154.04096c66.38619-66.478128 66.38619-175.271166 0-241.703125L596.06785 425.136949 596.06785 425.136949z"  ></path>' +
    '' +
    '</symbol>' +
    '' +
    '<symbol id="icon-f-plus" viewBox="0 0 1024 1024">' +
    '' +
    '<path d="M143.114 143.11v737.781h737.774v-737.781h-737.774zM828.188 828.192h-632.378v-632.385h632.378v632.385z"  ></path>' +
    '' +
    '<path d="M274.866 485.656h474.283v52.701h-474.283v-52.701z"  ></path>' +
    '' +
    '<path d="M532.094 280.221v474.276h-52.684v-474.276h52.684z"  ></path>' +
    '' +
    '</symbol>' +
    '' +
    '<symbol id="icon-yanjing" viewBox="0 0 1024 1024">' +
    '' +
    '<path d="M512 209.403241c-201.731514 0-374.009206 125.476783-443.808922 302.596759 69.798692 177.119977 242.077408 302.596759 443.808922 302.596759 201.933105 0 374.010229-125.476783 443.808922-302.596759C886.009206 334.880023 713.933105 209.403241 512 209.403241zM512 713.731514c-111.355157 0-201.731514-90.375334-201.731514-201.731514s90.375334-201.731514 201.731514-201.731514 201.731514 90.375334 201.731514 201.731514S623.355157 713.731514 512 713.731514zM512 390.961296c-66.772776 0-121.038704 54.265928-121.038704 121.038704s54.265928 121.038704 121.038704 121.038704 121.038704-54.265928 121.038704-121.038704S578.772776 390.961296 512 390.961296z"  ></path>' +
    '' +
    '</symbol>' +
    '' +
    '<symbol id="icon-fabu" viewBox="0 0 1029 1024">' +
    '' +
    '<path d="M867.827533 817.959378 450.029695 689.39684l417.797838-482.139922L321.467158 689.39684 0 560.834303 1028.500297 14.473928 867.827533 817.959378 867.827533 817.959378zM450.029695 1010.863998l0-225.014847L578.592232 850.191234 450.029695 1010.863998 450.029695 1010.863998zM450.029695 1010.863998"  ></path>' +
    '' +
    '</symbol>' +
    '' +
    '<symbol id="icon-gereninfo" viewBox="0 0 1024 1024">' +
    '' +
    '<path d="M773.721 746.676l-186.178-72.55c0 0-35.496-13.793-49.289-27.343-8.871-8.718-8.23-29.272-0.385-55.539 7.845-26.253 103.276-132.971 103.276-229.903 0-149.733-98.412-271.118-219.821-271.118-121.396 0-219.809 121.385-219.809 271.118 0 92.842 85.035 203.528 95.534 223.647 10.512 20.12 7.954 50.776-0.333 60.07-12.455 13.953-57.949 27.939-57.949 27.939l-167.84 74.806C31.714 761.885 1 798.861 1 840.595l0 19.779c0 45.54 36.983 73.402 82.432 73.402L364.92 933.776l96.489 0 299.812 0c45.456 0 82.434-27.862 82.434-73.402l0-19.779C843.655 798.861 812.934 760.751 773.721 746.676L773.721 746.676 773.721 746.676 773.721 746.676zM761.216 894.364 83.432 894.364c-15.145 0-41.918-26.671-41.123-53.77 0.808-27.1 22.754-41.444 40.296-47.745l166.732-73.678c0 0 56.525-15.696 77.1-43.117 19.216-25.618 19.139-50.109 15.204-73.189-5.398-31.58-4.968-39.561-24.306-62.961-19.242-23.28-77.022-105.738-77.022-178.397 0-117.172 86.144-231.672 181.146-231.672 94.996 0 182.268 114.5 182.268 231.672 0 75.858-62.551 146.983-81.945 179.909-21.197 35.99-24.606 51.616-26.203 66.513-1.597 14.896-2.576 49.43 9.576 68.126 12.152 18.697 63.82 37.618 63.82 37.618l186.19 72.55c17.543 6.307 48.591 31.938 49.161 55.487C804.902 865.265 776.361 894.364 761.216 894.364L761.216 894.364 761.216 894.364 761.216 894.364zM761.216 894.364"  ></path>' +
    '' +
    '<path d="M741.513 426.475c-19.376 0-35.086-2.962-35.086-23.734 0-20.773 15.71-23.735 35.086-23.735l246.523 0c19.356 0 33.951 2.962 33.951 23.735 0 20.772-16.845 23.734-36.207 23.734L741.513 426.475 741.513 426.475 741.513 426.475 741.513 426.475zM741.513 426.475"  ></path>' +
    '' +
    '<path d="M793.782 566.754c-19.363 0-35.079-2.962-35.079-23.741 0-20.767 15.716-23.729 35.079-23.729l194.722 0c19.363 0 32.83 2.962 32.83 23.729 0 20.779-14.595 23.741-33.952 23.741L793.782 566.754 793.782 566.754 793.782 566.754 793.782 566.754zM793.782 566.754"  ></path>' +
    '' +
    '<path d="M858.544 698.893c-19.376 0-35.086-2.968-35.086-23.741s15.71-23.728 35.086-23.728l130.53 0c19.363 0 33.926 2.954 33.926 23.728s-15.69 23.741-35.054 23.741L858.544 698.893 858.544 698.893 858.544 698.893 858.544 698.893zM858.544 698.893"  ></path>' +
    '' +
    '</symbol>' +
    '' +
    '<symbol id="icon-renwu" viewBox="0 0 1024 1024">' +
    '' +
    '<path d="M658.614707 649.777947c-51.479465-12.371772-76.937277-79.836303-31.416524-127.696334 60.920488-58.503439 101.498672-158.347424 101.498672-257.735016 0-153.919579-97.018637-247.654426-216.695321-247.654426-119.677707 0-216.697367 93.734848-216.697367 247.654426 0 99.029434 40.324404 198.621686 100.862175 257.124102l-0.356111 0c46.435589 48.114834 20.570501 116.390847-31.465642 128.510886-201.448058 38.899962-347.651908 150.19986-347.651908 233.498008 0 102.597703 221.73715 123.827213 495.307829 123.827213 273.569656 0 495.305783-21.228487 495.305783-123.827213C1007.307318 800.031019 860.595908 688.527482 658.614707 649.777947z"  ></path>' +
    '' +
    '</symbol>' +
    '' +
    '<symbol id="icon-wenzi1" viewBox="0 0 1024 1024">' +
    '' +
    '<path d="M955.785846 952.201846c-21.346462-19.456-48.600615-66.599385-81.801846-141.548308L526.217846 19.928615l-13.508923 0L167.857231 789.346462c-32.728615 73.452308-60.219077 121.974154-82.510769 145.408S34.619077 972.563692 0 977.762462l0 26.308923 320.748308 0 0-26.308923c-50.254769-3.780923-81.762462-9.452308-94.562462-17.092923-21.819077-12.760615-32.728615-32.689231-32.728615-59.746462 0-20.401231 6.656-46.198154 19.928615-77.508923l40.526769-93.853538 340.598154 0 51.2 120.162462c13.272615 31.310769 20.401231 49.073231 21.346462 53.326769 2.835692 9.019077 4.253538 17.762462 4.253538 26.308923 0 14.217846-5.238154 25.127385-15.635692 32.689231-15.163077 10.476308-41.511385 15.635692-78.926769 15.635692l-19.180308 0 0 26.308923L1024 1003.992615l0-26.308923C994.619077 975.438769 971.894154 966.892308 955.785846 952.201846zM278.764308 676.982154l147.928615-332.130462 143.596308 332.130462L278.764308 676.982154z"  ></path>' +
    '' +
    '</symbol>' +
    '' +
    '<symbol id="icon-anquan" viewBox="0 0 1024 1024">' +
    '' +
    '<path d="M697.5 62.3C610.2 37.8 512 0 512 0s-98.2 37.8-185.5 62.3C239.3 86.8 76.8 89 76.8 89l0 267.1c0 0 21.8 247.1 63.3 322.8 48 140.2 238.8 293.8 371.9 345 133.1-51.2 323.9-204.8 371.9-345 41.5-75.7 63.3-322.8 63.3-322.8L947.2 89C947.2 89 784.7 86.8 697.5 62.3zM837.4 345.1 475.9 709.6c-9.1 9.1-23.8 9.1-32.9 0l-7.3-7.4 0 0-7.9-8-34.1-34.4c-0.2-0.2-0.3-0.5-0.5-0.8L236.9 500.3c-9.1-9.1-9.1-24 0-33.1l49.3-49.7c9.1-9.2 23.8-9.2 32.9 0l140.6 142.8 295.6-298.1c9.1-9.2 23.8-9.2 32.9 0l49.3 49.7C846.5 321.1 846.5 335.9 837.4 345.1z"  ></path>' +
    '' +
    '</symbol>' +
    '' +
    '<symbol id="icon-image" viewBox="0 0 1024 1024">' +
    '' +
    '<path d="M736 448c53 0 96-43 96-96 0-53-43-96-96-96-53 0-96 43-96 96C640 405 683 448 736 448zM904 128 120 128c-31.2 0-56 25.4-56 56.6l0 654.8c0 31.2 24.8 56.6 56 56.6l784 0c31.2 0 56-25.4 56-56.6L960 184.6C960 153.4 935.2 128 904 128zM697.8 523.4c-6-7-15.2-12.4-25.6-12.4-10.2 0-17.4 4.8-25.6 11.4l-37.4 31.6c-7.8 5.6-14 9.4-23 9.4-8.6 0-16.4-3.2-22-8.2-2-1.8-5.6-5.2-8.6-8.2L448 430.6c-8-9.2-20-15-33.4-15-13.4 0-25.8 6.6-33.6 15.6L128 736.4 128 215.4c2-13.6 12.6-23.4 26.2-23.4l715.4 0c13.8 0 25 10.2 25.8 24l0.6 520.8L697.8 523.4z"  ></path>' +
    '' +
    '</symbol>' +
    '' +
    '<symbol id="icon-lianxiwomen" viewBox="0 0 1024 1024">' +
    '' +
    '<path d="M508.58496 18.60096c-270.62272 0-489.98912 219.3664-489.98912 489.98912s219.392 489.98912 489.98912 489.98912c270.59712 0 489.98912-219.392 489.98912-489.98912C998.57408 237.96224 779.18208 18.60096 508.58496 18.60096zM718.40256 668.77952c-8.22784 6.93248-11.8784 17.8944-9.40544 28.3648l19.21536 81.69472-118.02624-47.14496c-3.36384-1.35168-6.9888-2.04288-10.61376-2.04288-2.21696 0-4.45952 0.26112-6.64576 0.77824-26.86464 6.41536-54.30784 9.66656-81.55136 9.66656-157.60384 0-285.81376-102.43072-285.81376-228.33664 0-125.90592 128.2048-228.33664 285.81376-228.33664s285.81376 102.43072 285.81376 228.33664C797.21472 570.22976 769.2288 626.03776 718.40256 668.77952z"  ></path>' +
    '' +
    '<path d="M368.47104 511.72352m-42.8032 0a8.36 8.36 0 1 0 85.6064 0 8.36 8.36 0 1 0-85.6064 0Z"  ></path>' +
    '' +
    '<path d="M511.40608 511.72352m-42.8032 0a8.36 8.36 0 1 0 85.6064 0 8.36 8.36 0 1 0-85.6064 0Z"  ></path>' +
    '' +
    '<path d="M654.3104 511.72352m-42.8032 0a8.36 8.36 0 1 0 85.6064 0 8.36 8.36 0 1 0-85.6064 0Z"  ></path>' +
    '' +
    '</symbol>' +
    '' +
    '<symbol id="icon-wenzi" viewBox="0 0 1024 1024">' +
    '' +
    '<path d="M698.444 147.804l8.7 186.4-26 0c-11.6-60.7-28.9-99.7-52-117-20.2-17.3-62.2-26-125.7-26l-60.7 0 0 567.9c0 40.5 5.8 66.5 17.3 78 14.4 11.6 44.8 18.8 91 21.7l0 21.7-325.1 0L225.944 858.704c46.2-2.8 75.1-11.5 86.7-26 11.5-8.7 17.3-37.5 17.3-86.7l0-554.9L269.344 191.104c-63.6 0-105.5 8.7-125.7 26-23.2 17.3-40.5 56.4-52 117l-26 0 8.7-186.4L698.444 147.704z"  ></path>' +
    '' +
    '<path d="M960.844 479.604l4.8 104-14.5 0c-6.5-33.9-16.1-55.6-29-65.3-11.3-9.7-34.7-14.5-70.2-14.5l-33.9 0L818.044 820.704c0 22.6 3.2 37.1 9.7 43.6 8.1 6.5 25 10.5 50.8 12.1l0 12.1L697.144 888.504l0-12.1c25.8-1.6 41.9-6.4 48.4-14.5 6.4-4.8 9.7-20.9 9.7-48.4l0-309.7L721.344 503.804c-35.5 0-58.9 4.8-70.2 14.5-12.9 9.7-22.6 31.5-29 65.3l-14.5 0 4.8-104L960.844 479.604z"  ></path>' +
    '' +
    '</symbol>' +
    '' +
    '<symbol id="icon-qqqun" viewBox="0 0 1024 1024">' +
    '' +
    '<path d="M765.435083 484.436224c0 13.113669-10.719132 23.74275-23.945365 23.742751H269.048689c-13.229303 0-23.950482-10.629081-23.950482-23.742751 0-13.101389 10.721179-23.735587 23.950482-23.735587h472.441029c13.226233 0 23.945365 10.634198 23.945365 23.735587z m0-177.827081c0 13.106506-10.719132 23.735587-23.945365 23.735587H269.048689c-13.229303 0-23.950482-10.629081-23.950482-23.735587 0-13.113669 10.721179-23.74275 23.950482-23.74275h472.441029c13.226233 0 23.945365 10.629081 23.945365 23.74275zM917.384797 588.455299c0 61.393255-50.387597 111.333668-112.328321 111.333668H698.849572v159.477155l-208.120015-159.477155H214.542284c-61.940724 0-112.325251-49.941436-112.325251-111.333668V223.366254c0-61.402465 50.384527-111.342878 112.325251-111.342878H805.056476c61.940724 0 112.328321 49.941436 112.328321 111.342878v365.089045zM805.057499 64.545038H214.542284c-88.350211 0-160.226215 71.247694-160.226214 158.821216v365.089045c0 87.571475 71.876004 158.812005 160.226214 158.812006h259.833817L746.745419 955.982884V747.267305h58.31208c88.352257 0 160.228261-71.240531 160.228261-158.812006V223.366254c0-87.573521-71.876004-158.821215-160.228261-158.821216z" fill="" ></path>' +
    '' +
    '</symbol>' +
    '' +
    '<symbol id="icon-lianjie1" viewBox="0 0 1024 1024">' +
    '' +
    '<path d="M569.89696 643.3024L465.52064 751.4112c-56.38144 58.40896-149.7088 60.1088-207.95904 3.85536-58.27584-56.32-59.82208-149.64736-3.43552-208.0512L358.5024 439.13728a32.9216 32.9216 0 0 0-0.83456-46.52032c-13.00992-12.5952-33.82784-12.17536-46.52032 0.83456L206.7712 501.5296c-81.57184 84.49536-79.28832 219.52 5.07392 301.06112 41.18528 39.77216 94.42304 59.53024 147.65568 59.53024 55.80288 0 111.61088-21.74976 153.37472-65.024l104.38144-108.1088a32.9216 32.9216 0 0 0-0.83456-46.52032c-13.01504-12.59008-33.89952-12.17536-46.52544 0.83456zM806.99392 186.23488c-84.39808-81.536-219.45856-79.06304-301.0304 5.49376L401.5872 299.80672a32.9216 32.9216 0 0 0 0.83456 46.52032c13.04576 12.65664 33.92512 12.24192 46.52032-0.83456l104.38144-108.07296c56.28416-58.40896 149.64736-60.13952 207.98976-3.82464 28.24192 27.27424 44.20608 63.90272 44.88192 103.09632 0.67584 39.26016-14.03904 76.4928-41.47712 104.89344l-104.38144 108.1088a32.9216 32.9216 0 0 0 0.83456 46.52032 32.70144 32.70144 0 0 0 22.84032 9.22112 32.86016 32.86016 0 0 0 23.68-10.05568l104.3456-108.1088c39.64416-40.99584 60.91264-94.90432 59.91424-151.70048-0.96256-56.77568-24.02816-109.81888-64.95744-149.33504z"  ></path>' +
    '' +
    '<path d="M591.16544 362.38848l-206.0288 213.35552a32.9216 32.9216 0 0 0 0.83456 46.52032 32.70144 32.70144 0 0 0 22.84032 9.22112 32.86016 32.86016 0 0 0 23.68-10.05568l206.0288-213.35552a32.9216 32.9216 0 0 0-0.83456-46.52032c-12.9792-12.5952-33.85856-12.2112-46.52032 0.83456z"  ></path>' +
    '' +
    '</symbol>' +
    '' +
    '<symbol id="icon-jieda" viewBox="0 0 1024 1024">' +
    '' +
    '<path d="M505.081 17c119.357 0 228.424 47.421 306.623 127.83C957.812 291.218 980.449 526.26 863.15 697.39c-47.33 70.1-115.24 123.707-193.44 156.695L531.835 994.285c-14.405 14.433-39.1 14.433-53.505 0v-2.061l-137.877-138.14c-80.257-32.988-146.109-86.595-193.44-156.695C29.714 526.26 50.292 291.217 198.46 144.83 276.66 64.42 385.725 17 505.081 17zM468.04 722.13c0 21.635 17.505 39.174 39.1 39.174 21.593 0 39.099-17.539 39.099-39.174 0-21.635-17.506-39.174-39.1-39.174s-39.1 17.539-39.1 39.174z m-55.563-369.06c0-26.802 10.29-47.42 26.753-63.915 8.231-10.308 20.578-16.494 30.868-20.617 12.347-4.124 24.694-8.248 37.041-8.248 22.637 0 45.273 8.248 63.794 26.804 8.232 8.247 12.347 16.494 18.52 24.741 8.232 16.494 12.348 35.05 10.29 53.606-2.058 16.495-10.29 35.05-24.694 47.421-6.174 6.186-14.405 12.371-22.637 16.495-20.578 10.309-41.157 22.68-57.62 45.359-16.463 22.68-28.81 53.606-28.81 101.027 0 22.68 16.463 39.174 39.1 39.174 22.636 0 41.157-18.556 41.157-41.235 0-26.804 4.115-43.298 12.347-53.607 8.231-10.309 20.579-16.494 32.926-22.68 14.405-8.247 28.81-18.555 39.1-30.926 26.752-26.803 41.157-59.792 47.33-94.842 4.116-32.989-2.058-70.1-18.52-103.09-8.232-14.432-18.521-28.864-30.869-41.235-34.983-35.05-78.199-49.483-119.356-49.483-24.694 0-47.33 4.124-67.91 14.433-20.578 8.247-41.157 22.68-57.62 37.112-28.81 30.926-49.389 72.162-49.389 121.645 0 22.68 16.463 39.174 39.1 39.174 22.636 0 39.1-16.494 39.1-37.112z"  ></path>' +
    '' +
    '</symbol>' +
    '' +
    '<symbol id="icon-da1" viewBox="0 0 1024 1024">' +
    '' +
    '<path d="M984.502857 999.619048H39.497143c-8.289524 0-15.11619-6.826667-15.116191-15.116191V39.497143C24.380952 31.207619 31.207619 24.380952 39.497143 24.380952h945.005714c8.289524 0 15.11619 6.826667 15.116191 15.116191v945.005714c0 8.289524-6.826667 15.11619-15.116191 15.116191z" fill="" ></path>' +
    '' +
    '</symbol>' +
    '' +
    '<symbol id="icon-xiao1" viewBox="0 0 1024 1024">' +
    '' +
    '<path d="M929.401905 66.31619c13.165714 0 24.380952 11.215238 24.380952 24.380953v837.729524c0 13.165714-11.215238 24.380952-24.380952 24.380952H91.672381c-13.165714 0-24.380952-11.215238-24.380952-24.380952V90.697143c0-13.165714 11.215238-24.380952 24.380952-24.380953h837.729524m0-44.373333H91.672381c-37.546667 0-68.754286 31.207619-68.754286 68.754286v837.729524c0 37.546667 31.207619 68.754286 68.754286 68.754285h837.729524c37.546667 0 68.754286-31.207619 68.754285-68.754285V90.697143c0-37.546667-31.207619-68.754286-68.754285-68.754286z" fill="" ></path>' +
    '' +
    '<path d="M129.219048 997.180952c-59.977143 0-106.300952-48.761905-106.300953-106.300952v-381.318095h487.619048v487.619047H129.219048" fill="" ></path>' +
    '' +
    '</symbol>' +
    '' +
    '<symbol id="icon-kuan1" viewBox="0 0 1024 1024">' +
    '' +
    '<path d="M930.864762 68.754286c13.165714 0 24.380952 11.215238 24.380952 24.380952v837.729524c0 13.165714-11.215238 24.380952-24.380952 24.380952H93.135238c-13.165714 0-24.380952-11.215238-24.380952-24.380952V93.135238c0-13.165714 11.215238-24.380952 24.380952-24.380952h837.729524m0-44.373334H93.135238C55.588571 24.380952 24.380952 55.588571 24.380952 93.135238v837.729524c0 37.546667 31.207619 68.754286 68.754286 68.754286h837.729524c37.546667 0 68.754286-31.207619 68.754286-68.754286V93.135238c0-37.546667-31.207619-68.754286-68.754286-68.754286z" fill="" ></path>' +
    '' +
    '<path d="M999.619048 930.864762c0 37.546667-31.207619 68.754286-68.754286 68.754286H93.135238C55.588571 999.619048 24.380952 968.411429 24.380952 930.864762" fill="" ></path>' +
    '' +
    '<path d="M24.380952 939.641905V512h975.238096v427.641905" fill="" ></path>' +
    '' +
    '</symbol>' +
    '' +
    '</svg>'
  var script = function() {
    var scripts = document.getElementsByTagName('script')
    return scripts[scripts.length - 1]
  }()
  var shouldInjectCss = script.getAttribute("data-injectcss")

  /**
   * document ready
   */
  var ready = function(fn) {
    if (document.addEventListener) {
      if (~["complete", "loaded", "interactive"].indexOf(document.readyState)) {
        setTimeout(fn, 0)
      } else {
        var loadFn = function() {
          document.removeEventListener("DOMContentLoaded", loadFn, false)
          fn()
        }
        document.addEventListener("DOMContentLoaded", loadFn, false)
      }
    } else if (document.attachEvent) {
      IEContentLoaded(window, fn)
    }

    function IEContentLoaded(w, fn) {
      var d = w.document,
        done = false,
        // only fire once
        init = function() {
          if (!done) {
            done = true
            fn()
          }
        }
        // polling for no errors
      var polling = function() {
        try {
          // throws errors until after ondocumentready
          d.documentElement.doScroll('left')
        } catch (e) {
          setTimeout(polling, 50)
          return
        }
        // no errors, fire

        init()
      };

      polling()
        // trying to always fire before onload
      d.onreadystatechange = function() {
        if (d.readyState == 'complete') {
          d.onreadystatechange = null
          init()
        }
      }
    }
  }

  /**
   * Insert el before target
   *
   * @param {Element} el
   * @param {Element} target
   */

  var before = function(el, target) {
    target.parentNode.insertBefore(el, target)
  }

  /**
   * Prepend el to target
   *
   * @param {Element} el
   * @param {Element} target
   */

  var prepend = function(el, target) {
    if (target.firstChild) {
      before(el, target.firstChild)
    } else {
      target.appendChild(el)
    }
  }

  function appendSvg() {
    var div, svg

    div = document.createElement('div')
    div.innerHTML = svgSprite
    svgSprite = null
    svg = div.getElementsByTagName('svg')[0]
    if (svg) {
      svg.setAttribute('aria-hidden', 'true')
      svg.style.position = 'absolute'
      svg.style.width = 0
      svg.style.height = 0
      svg.style.overflow = 'hidden'
      prepend(svg, document.body)
    }
  }

  if (shouldInjectCss && !window.__iconfont__svg__cssinject__) {
    window.__iconfont__svg__cssinject__ = true
    try {
      document.write("<style>.svgfont {display: inline-block;width: 1em;height: 1em;fill: currentColor;vertical-align: -0.1em;font-size:16px;}</style>");
    } catch (e) {
      console && console.log(e)
    }
  }

  ready(appendSvg)


})(window)