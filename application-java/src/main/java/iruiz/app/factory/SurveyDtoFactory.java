package iruiz.app.factory;

import org.springframework.context.annotation.Configuration;
import iruiz.app.dto.SurveyDto;
import iruiz.survey.domain.model.Survey;

@Configuration
public class SurveyDtoFactory {
	
	public SurveyDto makeFromSurveyModel(Survey survey){
		SurveyDto surveyDto = new SurveyDto();
		
		surveyDto.name = survey.getName();
		surveyDto.description = survey.getDescription();
		
		return surveyDto;
	}
}
