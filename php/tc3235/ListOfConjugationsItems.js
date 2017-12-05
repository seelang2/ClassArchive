//added to try and create a gloabal for the list in order to optimize code optimize the page assistant's code
// This would allow me to remove the creation of the long list from the page assistant
function listOfConjugationsItems(intIndex) {
	this.itemsLOCI = [ 
		{
			category: "Personal Infinitive",
			firstSing: obj501PVModel.items.portugueseverbs[intIndex].PersInf1stSing,
			firstPlu: obj501PVModel.items.portugueseverbs[intIndex].PersInf1stPlu,
			secondSing: obj501PVModel.items.portugueseverbs[intIndex].PersInf2ndSing,
			secondPlu: obj501PVModel.items.portugueseverbs[intIndex].PersInf2ndPlu,
			thirdSing: obj501PVModel.items.portugueseverbs[intIndex].PersInf3rdSing,
			thirdPlu: obj501PVModel.items.portugueseverbs[intIndex].PersInf3rdPlu
		},
		{
			category: "Present Indicative",
			firstSing: obj501PVModel.items.portugueseverbs[intIndex].PresInd1stSing,
			firstPlu: obj501PVModel.items.portugueseverbs[intIndex].PresInd1stPlu,
			secondSing: obj501PVModel.items.portugueseverbs[intIndex].PresInd2ndSing,
			secondPlu: obj501PVModel.items.portugueseverbs[intIndex].PresInd2ndPlu,
			thirdSing: obj501PVModel.items.portugueseverbs[intIndex].PresInd3rdSing,
			thirdPlu: obj501PVModel.items.portugueseverbs[intIndex].PresInd3rdPlu
		},
		{
			category: "Imperfect Indicative",
			firstSing: obj501PVModel.items.portugueseverbs[intIndex].ImpInd1stSing,
			firstPlu: obj501PVModel.items.portugueseverbs[intIndex].ImpInd1stPlu,
			secondSing: obj501PVModel.items.portugueseverbs[intIndex].ImpInd2ndSing,
			secondPlu: obj501PVModel.items.portugueseverbs[intIndex].ImpInd2ndPlu,
			thirdSing: obj501PVModel.items.portugueseverbs[intIndex].ImpInd3rdSing,
			thirdPlu: obj501PVModel.items.portugueseverbs[intIndex].ImpInd3rdPlu
		},
		{
			category: "Preterit Indicative",
			firstSing: obj501PVModel.items.portugueseverbs[intIndex].PretInd1stSing,
			firstPlu: obj501PVModel.items.portugueseverbs[intIndex].PretInd1stPlu,
			secondSing: obj501PVModel.items.portugueseverbs[intIndex].PretInd2ndSing,
			secondPlu: obj501PVModel.items.portugueseverbs[intIndex].PretInd2ndPlu,
			thirdSing: obj501PVModel.items.portugueseverbs[intIndex].PretInd3rdSing,
			thirdPlu: obj501PVModel.items.portugueseverbs[intIndex].PretInd3rdPlu
		},
		{
			// Simple Pluperfect Indicative
			category: "Pluperfect Indicative",
			firstSing: obj501PVModel.items.portugueseverbs[intIndex].SimpPlupInd1stSing,
			firstPlu: obj501PVModel.items.portugueseverbs[intIndex].SimpPlupInd1stPlu,
			secondSing: obj501PVModel.items.portugueseverbs[intIndex].SimpPlupInd2ndSing,
			secondPlu: obj501PVModel.items.portugueseverbs[intIndex].SimpPlupInd2ndPlu,
			thirdSing: obj501PVModel.items.portugueseverbs[intIndex].SimpPlupInd3rdSing,
			thirdPlu: obj501PVModel.items.portugueseverbs[intIndex].SimpPlupInd3rdPlu
		},
		{
			category: "Future Indicative",
			firstSing: obj501PVModel.items.portugueseverbs[intIndex].FutInd1stSing,
			firstPlu: obj501PVModel.items.portugueseverbs[intIndex].FutInd1stPlu,
			secondSing: obj501PVModel.items.portugueseverbs[intIndex].FutInd2ndSing,
			secondPlu: obj501PVModel.items.portugueseverbs[intIndex].FutInd2ndPlu,
			thirdSing: obj501PVModel.items.portugueseverbs[intIndex].FutInd3rdSing,
			thirdPlu: obj501PVModel.items.portugueseverbs[intIndex].FutInd3rdPlu
		},
		{
			// Present Perfect Indicative
			category: "Pres Perf Indicative",
			firstSing: obj501PVModel.items.portugueseverbs[intIndex].PresPerfInd1stSing,
			firstPlu: obj501PVModel.items.portugueseverbs[intIndex].PresPerfInd1stPlu,
			secondSing: obj501PVModel.items.portugueseverbs[intIndex].PresPerfInd2ndSing,
			secondPlu: obj501PVModel.items.portugueseverbs[intIndex].PresPerfInd2ndPlu,
			thirdSing: obj501PVModel.items.portugueseverbs[intIndex].PresPerfInd3rdSing,
			thirdPlu: obj501PVModel.items.portugueseverbs[intIndex].PresPerfInd3rdPlu
		},
		{
			// Past Perfect Indicative
			category: "Past Perf Indicative",
			firstSing: obj501PVModel.items.portugueseverbs[intIndex].PastOrPluPerfInd1stSing,
			firstPlu: obj501PVModel.items.portugueseverbs[intIndex].PastOrPluPerfInd1stPlu,
			secondSing: obj501PVModel.items.portugueseverbs[intIndex].PastOrPluPerfInd2ndSing,
			secondPlu: obj501PVModel.items.portugueseverbs[intIndex].PastOrPluPerfInd2ndPlu,
			thirdSing: obj501PVModel.items.portugueseverbs[intIndex].PastOrPluPerfInd3rdSing,
			thirdPlu: obj501PVModel.items.portugueseverbs[intIndex].PastOrPluPerfInd3rdPlu
		},
		{
			// Future Perfect Indicative
			category: "Fut Perf Indicative",
			firstSing: obj501PVModel.items.portugueseverbs[intIndex].FutPerfInd1stSing,
			firstPlu: obj501PVModel.items.portugueseverbs[intIndex].FutPerfInd1stPlu,
			secondSing: obj501PVModel.items.portugueseverbs[intIndex].FutPerfInd2ndSing,
			secondPlu: obj501PVModel.items.portugueseverbs[intIndex].FutPerfInd2ndPlu,
			thirdSing: obj501PVModel.items.portugueseverbs[intIndex].FutPerfInd3rdSing,
			thirdPlu: obj501PVModel.items.portugueseverbs[intIndex].FutPerfInd3rdPlu
		},
		{
			category: "Present Subjunctive",
			firstSing: obj501PVModel.items.portugueseverbs[intIndex].PresSub1stSing,
			firstPlu: obj501PVModel.items.portugueseverbs[intIndex].PresSub1stPlu,
			secondSing: obj501PVModel.items.portugueseverbs[intIndex].PresSub2ndSing,
			secondPlu: obj501PVModel.items.portugueseverbs[intIndex].PresSub2ndPlu,
			thirdSing: obj501PVModel.items.portugueseverbs[intIndex].PresSub3rdSing,
			thirdPlu: obj501PVModel.items.portugueseverbs[intIndex].PresSub3rdPlu
		},
		{
			category: "Imperfect Subjunctive",
			firstSing: obj501PVModel.items.portugueseverbs[intIndex].ImpSub1stSing,
			firstPlu: obj501PVModel.items.portugueseverbs[intIndex].ImpSub1stPlu,
			secondSing: obj501PVModel.items.portugueseverbs[intIndex].ImpSub2ndSing,
			secondPlu: obj501PVModel.items.portugueseverbs[intIndex].ImpSub2ndPlu,
			thirdSing: obj501PVModel.items.portugueseverbs[intIndex].ImpSub3rdSing,
			thirdPlu: obj501PVModel.items.portugueseverbs[intIndex].ImpSub3rdPlu
		},
		{
			category: "Future Subjunctive",
			firstSing: obj501PVModel.items.portugueseverbs[intIndex].FutSub1stSing,
			firstPlu: obj501PVModel.items.portugueseverbs[intIndex].FutSub1stPlu,
			secondSing: obj501PVModel.items.portugueseverbs[intIndex].FutSub2ndSing,
			secondPlu: obj501PVModel.items.portugueseverbs[intIndex].FutSub2ndPlu,
			thirdSing: obj501PVModel.items.portugueseverbs[intIndex].FutSub3rdSing,
			thirdPlu: obj501PVModel.items.portugueseverbs[intIndex].FutSub3rdPlu
		},
		{
			// "Present Perfect Subjunctive"
			category: "Pres Perf Subjunctive",
			firstSing: obj501PVModel.items.portugueseverbs[intIndex].PresPerfSub1stSing,
			firstPlu: obj501PVModel.items.portugueseverbs[intIndex].PresPerfSub1stPlu,
			secondSing: obj501PVModel.items.portugueseverbs[intIndex].PresPerfSub2ndSing,
			secondPlu: obj501PVModel.items.portugueseverbs[intIndex].PresPerfSub2ndPlu,
			thirdSing: obj501PVModel.items.portugueseverbs[intIndex].PresPerfSub3rdSing,
			thirdPlu: obj501PVModel.items.portugueseverbs[intIndex].PresPerfSub3rdPlu
		},
		{
			// "Past Perfect Subjunctive"
			category: "Past Perf Subjunctive",
			firstSing: obj501PVModel.items.portugueseverbs[intIndex].PastOrPluPerfSub1stSing,
			firstPlu: obj501PVModel.items.portugueseverbs[intIndex].PastOrPluPerfSub1stPlu,
			secondSing: obj501PVModel.items.portugueseverbs[intIndex].PastOrPluPerfSub2ndSing,
			secondPlu: obj501PVModel.items.portugueseverbs[intIndex].PastOrPluPerfSub2ndPlu,
			thirdSing: obj501PVModel.items.portugueseverbs[intIndex].PastOrPluPerfSub3rdSing,
			thirdPlu: obj501PVModel.items.portugueseverbs[intIndex].PastOrPluPerfSub3rdPlu
		},
		{
			// "Future Perfect Subjunctive"
			category: "Fut Perf Subjunctive",
			firstSing: obj501PVModel.items.portugueseverbs[intIndex].FutPerfSub1stSing,
			firstPlu: obj501PVModel.items.portugueseverbs[intIndex].FutPerfSub1stPlu,
			secondSing: obj501PVModel.items.portugueseverbs[intIndex].FutPerfSub2ndSing,
			secondPlu: obj501PVModel.items.portugueseverbs[intIndex].FutPerfSub2ndPlu,
			thirdSing: obj501PVModel.items.portugueseverbs[intIndex].FutPerfSub3rdSing,
			thirdPlu: obj501PVModel.items.portugueseverbs[intIndex].FutPerfSub3rdPlu
		},
		{
			category: "Conditional",
			firstSing: obj501PVModel.items.portugueseverbs[intIndex].Cond1stSing,
			firstPlu: obj501PVModel.items.portugueseverbs[intIndex].Cond1stPlu,
			secondSing: obj501PVModel.items.portugueseverbs[intIndex].Cond2ndSing,
			secondPlu: obj501PVModel.items.portugueseverbs[intIndex].Cond2ndPlu,
			thirdSing: obj501PVModel.items.portugueseverbs[intIndex].Cond3rdSing,
			thirdPlu: obj501PVModel.items.portugueseverbs[intIndex].Cond3rdPlu
		},
		{
			category: "Conditional Perfect",
			firstSing: obj501PVModel.items.portugueseverbs[intIndex].CondPerf1stSing,
			firstPlu: obj501PVModel.items.portugueseverbs[intIndex].CondPerf1stPlu,
			secondSing: obj501PVModel.items.portugueseverbs[intIndex].CondPerf2ndSing,
			secondPlu: obj501PVModel.items.portugueseverbs[intIndex].CondPerf2ndPlu,
			thirdSing: obj501PVModel.items.portugueseverbs[intIndex].CondPerf3rdSing,
			thirdPlu: obj501PVModel.items.portugueseverbs[intIndex].CondPerf3rdPlu
		},
		{
			category: "Imperative",
			firstSing: obj501PVModel.items.portugueseverbs[intIndex].Imperative
		}
	]; // listMLOCI
	return this.itemsLOCI;
} // listOfConjugationsItems