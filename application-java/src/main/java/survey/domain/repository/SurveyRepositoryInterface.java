package survey.domain.repository;

import survey.domain.model.Survey;

public interface SurveyRepositoryInterface {
	
	public Survey[] findAll();
	
	public Survey findOneBySlug(String slug);
	
}
