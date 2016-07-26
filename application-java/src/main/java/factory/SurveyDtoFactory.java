package factory;

import dto.SurveyDto;
import survey.domain.model.Survey;

public class SurveyDtoFactory {
	
	public SurveyDto makeFromSurveyModel(Survey survey){
		SurveyDto surveyDto = new SurveyDto();
		
		surveyDto.name = survey.getName();
		surveyDto.description = survey.getDescription();
		
		return surveyDto;
	}
}
